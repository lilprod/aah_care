<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();

        return view('admin.faqs.index')->with('faqs', $faqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer'  => 'required',
            
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $faq = new Faq();
        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');

        $faq->save();

        return redirect()->route('faqs.index')
            ->with('success',
             'Faq added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id); //Get faq specified by id

        return view('admin.faqs.show', compact('faq'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id); //Get faq specified by id

        return view('admin.faqs.edit', compact('faq'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $this->validate($request, [
            'question' => 'required',
            'answer'  => 'required',
            
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );


        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');

        $faq->save();

        return redirect()->route('faqs.index')
            ->with('success', 'Faq updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a faq with a given id and delete
        $faq = Faq::findOrFail($id);

        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success',
             'Faq deleted successfully.');
    
    }
}
