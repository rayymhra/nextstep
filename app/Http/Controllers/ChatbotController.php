<?php
// app/Http/Controllers/ChatbotController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
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

        $userMessage = strtolower(trim($request->message));
        $response = $this->getResponse($userMessage);

        return response()->json([
            'user_message' => $request->message,
            'bot_response' => $response,
            'timestamp' => now()->format('g:i A')
        ]);
    }

    private function getResponse($message)
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