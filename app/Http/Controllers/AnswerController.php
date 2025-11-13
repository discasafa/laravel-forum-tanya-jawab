<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AnswerController extends Controller
{
    /**
     * Menyimpan jawaban baru ke database.
     */
    public function store(Request $request, Question $question)
    {
        // 1. Validasi
        $request->validate([
            'content' => 'required|string|min:5',
        ]);

        // 2. Buat jawaban
        $question->answers()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        // 3. Notifikasi sukses
        Alert::success('Berhasil!', 'Jawaban berhasil ditambahkan.');

        // 4. Redirect kembali ke halaman pertanyaan
        return redirect()->route('questions.show', $question);
    }

    /**
     * Menampilkan form untuk mengedit jawaban.
     */
    public function edit(Answer $answer)
    {
        // 1. Otorisasi
        $this->authorize('update', $answer);

        // 2. Tampilkan view
        return view('answers.edit', compact('answer'));
    }

    /**
     * Update jawaban di database.
     */
    public function update(Request $request, Answer $answer)
    {
        // 1. Otorisasi
        $this->authorize('update', $answer);

        // 2. Validasi
        $request->validate([
            'content' => 'required|string|min:5',
        ]);

        // 3. Update jawaban
        $answer->update([
            'content' => $request->content,
        ]);

        // 4. Redirect kembali ke halaman pertanyaan (question.show)
        Alert::info('Diperbarui!', 'Jawaban berhasil diperbarui.');
        return redirect()->route('questions.show', $answer->question);
    }


    /**
     * Menghapus jawaban dari database.
     */
    public function destroy(Answer $answer)
    {
        // 1. Otorisasi
        $this->authorize('delete', $answer);

        // Simpan question_id sebelum dihapus untuk redirect
        $questionId = $answer->question_id;

        // 2. Hapus jawaban
        $answer->delete();

        // 3. Redirect kembali ke halaman pertanyaan
        Alert::warning('Dihapus!', 'Jawaban berhasil dihapus.');
        return redirect()->route('questions.show', $questionId);
    }
}
