<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Requests\CheckUpload;
use App\Type;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $doc_types = Type::all();
        $docs = Document::where('user_id', Auth::id())->get();

        return view('home', compact('doc_types', 'docs', 'storagePath'));
    }

    public function show($id)
    {
        $belongsToUser = false;

        // get chosen document
        $document = Document::where('user_id', Auth::id())->where('id', $id)->first();

        // if user tries to access someone else's document, access will be denied
        if($document === NULL)
            return redirect()->back()->with('danger', 'Dokument ne pripada vama');

        // download chosen file
        return response()->download(storage_path('app\\'.$document->path));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'doc_type' => 'required',
            'doc_file' => 'required|mimes:doc,pdf,docx',
        ]);
        if($validation->passes())
        {
            $file = $request->file('doc_file');

            $ext = $file->getClientOriginalExtension();

            $path = $file->storeAs('documents', uniqid() . ".{$ext}");

            $document = new Document();
            $document->user_id = Auth::id();
            $document->type_id = $request->doc_type;
            $document->path = $path;
            $document->save();



            $doc = Document::where('path', $path)->first();
            $doc_count = Document::where('user_id', Auth::id())->count();

            $show_route = '/show/'.$doc->id;

            return response()->json([
                'message1'   => 'Dokument uspješno pohranjen',
                'message1css1' => 'display',
                'message1css2' => 'block',
                'message2'   => '',
                'message2css1'   => 'display',
                'message2css2'   => 'none',
                'class_name'  => 'alert-success',
                'new_table_row' => '<tr class="new_file_row"><td scope="row">'.$doc_count.'</td>
                                    <td><form action="'.$show_route.'" id="editFile" method="post">
                                         '.csrf_field().' 
                                        <button class="btn btn-link" type="submit">'.$doc->type->name.'</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </td>
                                <td><form method="post" class="form-delete">
                                        '.csrf_field().' 
                                        '.method_field('delete').'
                                        <button class="btn btn-link delete" type="submit" value="'.$doc->id.'"
                                                onclick="return confirm(\'Brisati? Da li ste sigurni?\')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td></tr>'
            ]);
        }
        else
        {
            return response()->json([
                'message1'   => '',
                'message1css1'   => 'display',
                'message1css2' => 'none',
                'message2'   => $validation->errors()->all(),
                'message2css1'   => 'display',
                'message2css2' => 'block',
                'new_table_row' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'doc_type' => 'required',
            'doc_file' => 'required|mimes:doc,pdf,docx',
        ]);
        if($validation->passes())
        {
            $file = $request->file('doc_file');

            $ext = $file->getClientOriginalExtension();

            $path = $file->storeAs('documents', uniqid() . ".{$ext}");

            $document = Document::where('id', $request->edit_id)->first();

            Storage::delete($document->path);

            $document->type_id = $request->doc_type;
            $document->path = $path;
            $document->save();

            $doc = Document::where('path', $path)->first();
            $doc_count = Document::where('user_id', Auth::id())->count();

            $show_route = '/show/'.$doc->id;

            return response()->json([
                'message1'   => 'Dokument uspješno uređen',
                'message1css1' => 'display',
                'message1css2' => 'block',
                'message2'   => '',
                'message2css1'   => 'display',
                'message2css2'   => 'none',
                'class_name'  => 'alert-success',
                'edited_row' => '<span></span>'
            ]);
        }
        else
        {
            return response()->json([
                'message1'   => '',
                'message1css1'   => 'display',
                'message1css2' => 'none',
                'message2'   => $validation->errors()->all(),
                'message2css1'   => 'display',
                'message2css2' => 'block',
                'edited_row' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function destroy($id)
    {
        $document = Document::where('id', $id)->first();
        $document->delete();

        Storage::delete($document->path);

        return response()->json(['message' => 'Dokument uspješno izbrisan']);
    }
}
