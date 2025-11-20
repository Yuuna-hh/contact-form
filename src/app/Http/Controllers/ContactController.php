<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    // 入力画面
    public function index()
    {
        return view('index');
    }

    // 確認画面
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'reply_method', 'content']);
        
        // 画像があれば一時保存
        $contact['image_path'] = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $contact['image_path'] = $image->store('tmp', 'public'); // tmpフォルダに保存
        }
        $request->session()->put('contact', $contact);

        return view('confirm', compact('contact'));
    }

    // データベース保存
    public function store(ContactRequest $request)
    {
        // セッションから contact データを取得
        $contactData = $request->session()->get('contact');

        if (!$contactData) {
            return redirect('/contacts')->with('error', 'セッションが切れています。もう一度入力してください。');
        }
        
        // 画像があれば最終保存
        // if ($request->filled('image_path')) {
        //     $tmpPath = $request->input('image_path');
        //     $fileName = basename($tmpPath);
        //     $finalPath = 'contacts/' . $fileName;
        //     \Storage::disk('public')->move($tmpPath, $finalPath);
        //     $contactData['image'] = $finalPath;
        // }
        if (!empty($contactData['image_path']) && \Storage::disk('public')->exists($contactData['image_path'])) {
            $fileName = basename($contactData['image_path']);
            $finalPath = 'contacts/' . $fileName;
            \Storage::disk('public')->move($contactData['image_path'], $finalPath);
            $contactData['image'] = $finalPath;
            unset($contactData['image_path']); // 一時パスは不要
        }

        // DBに保存
        Contact::create($contactData);

        // セッション削除（重複保存防止）
        $request->session()->forget('contact');
        
        return view('thanks');
    }

}