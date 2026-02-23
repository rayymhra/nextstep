<?php
// app/Http/Controllers/ChatbotController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ChatbotController extends Controller
{
    // Local responses as fallback
    private $responses = [
        'hello' => [
            "Hello! I'm your career assistant. How can I help you today?",
            "Hi there! Ready to take the next step in your career?",
            "Welcome! I'm here to help with your career questions."
        ],
        'resume' => [
            "For resumes, focus on achievements with numbers and metrics. Use action verbs like 'developed', 'managed', 'increased'.",
            "Keep your resume to 1-2 pages maximum. Tailor it for each job application.",
            "Use a clean, professional format. Include relevant keywords from the job description."
        ],
        'interview' => [
            "Research the company thoroughly before interviews. Prepare 3-5 questions to ask the interviewer.",
            "Practice common interview questions using the STAR method (Situation, Task, Action, Result).",
            "Dress professionally and arrive 10-15 minutes early for in-person interviews."
        ],
        'career' => [
            "Consider taking online courses to develop new skills. Our Academy section has great options!",
            "Networking is key - attend industry events and connect with professionals on LinkedIn.",
            "Set clear career goals and break them down into actionable steps."
        ],
        'portfolio' => [
            "Your portfolio should showcase your best work. Include project descriptions and outcomes.",
            "Make sure your portfolio is updated regularly with recent projects.",
            "Include case studies that demonstrate your problem-solving skills."
        ],
        'skills' => [
            "Identify in-demand skills in your industry and focus on developing them.",
            "Consider both technical skills and soft skills like communication and teamwork.",
            "Use online platforms like Coursera, Udemy, or our Academy for skill development."
        ],
        'default' => [
            "I'm here to help with career advice! You can ask me about resumes, interviews, career growth, or skills.",
            "That's an interesting question! While I'm a basic demo, I can share general career tips and guidance.",
            "I'm designed to provide career advice. Try asking about resumes, interviews, or career development!"
        ]
    ];

    public function index()
    {
        return view('chatbot.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $userMessage = trim($request->message);
        
        // Try AI API first, fallback to local responses
        try {
            $aiResponse = $this->getAIResponse($userMessage);
            
            return response()->json([
                'user_message' => $request->message,
                'bot_response' => $aiResponse,
                'timestamp' => now()->format('g:i A'),
                'source' => 'ai'
            ]);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('AI API Error: ' . $e->getMessage());
            
            // Fallback to local responses if AI fails
            $response = $this->getLocalResponse(strtolower($userMessage));
            
            return response()->json([
                'user_message' => $request->message,
                'bot_response' => $response,
                'timestamp' => now()->format('g:i A'),
                'source' => 'local',
                'error' => $e->getMessage()
            ]);
        }
    }

    private function getAIResponse($message)
    {
        // Cache responses for 1 hour to reduce API calls
        $cacheKey = 'chat_response_' . md5($message);
        
        return Cache::remember($cacheKey, 3600, function () use ($message) {
            // Try multiple AI services in order of preference
            $providers = [
                'huggingface',
                'cohere',
                'openai_rapidapi'
            ];
            
            foreach ($providers as $provider) {
                try {
                    if ($provider === 'huggingface' && env('HUGGINGFACE_TOKEN')) {
                        return $this->callHuggingFaceAPI($message);
                    }
                    
                    if ($provider === 'cohere' && env('COHERE_API_KEY')) {
                        return $this->callCohereAPI($message);
                    }
                    
                    if ($provider === 'openai_rapidapi' && env('RAPIDAPI_KEY')) {
                        return $this->callOpenAIAPI($message);
                    }
                    
                    if ($provider === 'gemini' && env('GEMINI_API_KEY')) {
                        return $this->callGeminiAPI($message);
                    }
                    
                } catch (\Exception $e) {
                    \Log::warning("Failed to get response from {$provider}: " . $e->getMessage());
                    continue; // Try next provider
                }
            }
            
            throw new \Exception('All AI providers failed');
        });
    }

    private function callHuggingFaceAPI($message)
    {
        $token = env('HUGGINGFACE_TOKEN');
        
        if (!$token) {
            throw new \Exception('Hugging Face token not configured');
        }

        // Try different models - career focused first
        $models = [
            'microsoft/DialoGPT-medium',
            'facebook/blenderbot-400M-distill',
            'google/flan-t5-base'
        ];
        
        foreach ($models as $model) {
            try {
                $response = Http::timeout(30)->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ])->post("https://api-inference.huggingface.co/models/{$model}", [
                    'inputs' => $this->formatHuggingFacePrompt($message),
                    'parameters' => [
                        'max_length' => 300,
                        'temperature' => 0.7,
                        'do_sample' => true,
                        'top_p' => 0.9,
                        'repetition_penalty' => 1.1,
                    ]
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    // Extract response based on model structure
                    if (isset($data[0]['generated_text'])) {
                        $generated = $data[0]['generated_text'];
                        // Clean up the response
                        $generated = $this->cleanAIResponse($generated);
                        return $generated;
                    } elseif (isset($data['generated_text'])) {
                        $generated = $data['generated_text'];
                        $generated = $this->cleanAIResponse($generated);
                        return $generated;
                    }
                }
            } catch (\Exception $e) {
                \Log::warning("Hugging Face model {$model} failed: " . $e->getMessage());
                continue;
            }
        }
        
        throw new \Exception('All Hugging Face models failed');
    }

    private function formatHuggingFacePrompt($message)
    {
        // Format prompt for better career-focused responses
        $systemPrompt = "You are CareerGPT, a professional career advisor. You provide helpful, actionable career advice.";
        
        $prompt = "Context: {$systemPrompt}\n\n";
        $prompt .= "User's career question: {$message}\n\n";
        $prompt .= "Your professional advice:";
        
        return $prompt;
    }

    private function callCohereAPI($message)
    {
        $apiKey = env('COHERE_API_KEY');
        
        if (!$apiKey) {
            throw new \Exception('Cohere API key not configured');
        }

        $response = Http::timeout(30)->withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
            'Cohere-Version' => '2022-12-06'
        ])->post('https://api.cohere.ai/generate', [
            'model' => 'command',
            'prompt' => $this->formatCoherePrompt($message),
            'max_tokens' => 300,
            'temperature' => 0.7,
            'k' => 0,
            'stop_sequences' => [],
            'return_likelihoods' => 'NONE'
        ]);

        if ($response->failed()) {
            throw new \Exception('Cohere API request failed');
        }

        $data = $response->json();
        
        if (isset($data['generations'][0]['text'])) {
            $generated = $data['generations'][0]['text'];
            return $this->cleanAIResponse($generated);
        }
        
        throw new \Exception('Invalid Cohere response');
    }

    private function formatCoherePrompt($message)
    {
        return "You are CareerGPT, a professional career advisor. Provide helpful, actionable advice for career development.\n\nQuestion: {$message}\n\nAdvice:";
    }

    private function callOpenAIAPI($message)
    {
        $apiKey = env('RAPIDAPI_KEY');
        
        if (!$apiKey) {
            throw new \Exception('RapidAPI key not configured');
        }

        $response = Http::timeout(30)->withHeaders([
            'X-RapidAPI-Key' => $apiKey,
            'X-RapidAPI-Host' => 'openai80.p.rapidapi.com',
            'Content-Type' => 'application/json',
        ])->post('https://openai80.p.rapidapi.com/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are CareerGPT, a professional career advisor. Provide helpful, actionable career advice. Focus on resumes, interviews, career growth, skills development, and portfolio building. Keep responses under 300 words.'
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'max_tokens' => 300,
            'temperature' => 0.7
        ]);

        if ($response->failed()) {
            throw new \Exception('OpenAI API request failed');
        }

        $data = $response->json();
        
        if (isset($data['choices'][0]['message']['content'])) {
            return trim($data['choices'][0]['message']['content']);
        }
        
        throw new \Exception('Invalid OpenAI response');
    }

    private function callGeminiAPI($message)
    {
        $apiKey = env('GEMINI_API_KEY');
        
        if (!$apiKey) {
            throw new \Exception('Gemini API key not configured');
        }

        $response = Http::timeout(30)->withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => "You are CareerGPT, a professional career advisor. Provide helpful, actionable career advice.\n\nQuestion: {$message}\n\nAdvice:"
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'maxOutputTokens' => 300,
                'temperature' => 0.7
            ]
        ]);

        if ($response->failed()) {
            throw new \Exception('Gemini API request failed');
        }

        $data = $response->json();
        
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return trim($data['candidates'][0]['content']['parts'][0]['text']);
        }
        
        throw new \Exception('Invalid Gemini response');
    }

    private function cleanAIResponse($text)
    {
        // Remove any system prompt remnants
        $text = preg_replace('/^.*?(CareerGPT|system|assistant):\s*/i', '', $text);
        
        // Remove multiple newlines
        $text = preg_replace('/\n\s*\n/', "\n\n", $text);
        
        // Trim whitespace
        $text = trim($text);
        
        // Ensure it ends with proper punctuation
        if (!preg_match('/[.!?]$/', $text)) {
            $text .= '.';
        }
        
        // Limit length
        if (strlen($text) > 1000) {
            $text = substr($text, 0, 997) . '...';
        }
        
        return $text;
    }

    private function getLocalResponse($message)
    {
        // Check for keywords in the message
        if (str_contains($message, 'hello') || str_contains($message, 'hi') || str_contains($message, 'hey')) {
            return $this->getRandomResponse('hello');
        } elseif (str_contains($message, 'resume') || str_contains($message, 'cv')) {
            return $this->getRandomResponse('resume');
        } elseif (str_contains($message, 'interview')) {
            return $this->getRandomResponse('interview');
        } elseif (str_contains($message, 'career') || str_contains($message, 'job') || str_contains($message, 'work')) {
            return $this->getRandomResponse('career');
        } elseif (str_contains($message, 'portfolio')) {
            return $this->getRandomResponse('portfolio');
        } elseif (str_contains($message, 'skill') || str_contains($message, 'learn')) {
            return $this->getRandomResponse('skills');
        } else {
            return $this->getRandomResponse('default');
        }
    }

    private function getRandomResponse($type)
    {
        $responses = $this->responses[$type];
        return $responses[array_rand($responses)];
    }
}