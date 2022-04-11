<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;
use Response;
use Carbon\Carbon;
use Auth;
use File;

class AdminController extends Controller
{
    public function dashboard(){

        return view('admin.dashboard');
    }
    
    //NEWS 
    public function news(){

        $data = DB::table('news')
            ->get();

        return view('admin.news.news', compact('data'));
    }

    public function newsInsert(Request $request){

        $data = request()->validate([
            'judulNews' => 'required|max:100',
            'deskripsiNews' => 'required',
            'tanggalNews' => 'required',
            'kategoriNews' => 'required',
        ]);
 
        DB::table('news')
            ->insert([
                'judulNews' => $request->judulNews,
                'deskripsiNews' => $request->deskripsiNews,
                'tanggalNews' => $request->tanggalNews,
                'kategoriNews' => $request->kategoriNews,
            ]);

        $maks = DB::table('news')
            ->max('id');

        $news = DB::table('news')
            ->where('id', $maks)
            ->first();

        $file = $request->file('fotoNews');
        if($file != null) {
            $name= 'fotoNews' . $news->id . '.' . $file->getClientOriginalExtension();
            $tujuan='images/news';
            $file->move($tujuan, $name);

            DB::table('news')
                ->where('id', $maks)
                ->update([
                    'photoNews' => $name
                ]);
        }
    }

    public function editNews($id){

        $news=DB::table('news')
                ->where('id', $id)
                ->first();

        return view('admin/news/editnews', compact('news'));
    }

     public function updateNews(Request $request){
            // dd($request);
 
            $data = request()->validate([
                'judulNews' => 'required|max:100',
                'deskripsiNews' => 'required',
                'tanggalNews' => 'required',
                'kategoriNews' => 'required',
            ]);
 
            DB::table('news')
                ->where('id', $request->idNews)
                ->update([
                    'judulNews' => $request->judulNews,
                    'deskripsiNews' => $request->deskripsiNews,
                    'tanggalNews' => $request->tanggalNews,
                    'kategoriNews' => $request->kategoriNews,
                ]);
 
            $file=$request->file('fotoNews');
            if ($file != null) {
 
                $name='fotoNews' . $request->idNews . '.' . $file->getClientOriginalExtension();
                if(File::exists(public_path('images/. $name .'))){
                    File::delete(public_path('images/. $name .'));
                    $tujuan='images/news';
                    $file->move($tujuan, $name);
                }else{
                    $tujuan='images/news';
                    $file->move($tujuan, $name);
                }

                DB::table('news')
                ->where('id', $request->idNews)
                ->update([
                    'photoNews' => $name,
                ]);
 
            }

            return redirect()->back()->with(['success' => 'Data telah terupdate']);;
    }
 
    public function deleteNews(Request $request){
 
        $news = DB::table('news')
                ->where('id', $request->id)
                ->first();
 
        File::delete('images/news/'.$news->photoNews);

        DB::table('news')
            ->where('id', $request->id)
            ->delete();

        return redirect(url()->previous());
    }

    //KATEGORI PROJECT 
    public function kategoriProject(){

        $data = DB::table('project')
            ->get();

        return view('admin.project.project', compact('data'));
    }

    public function insertKategoriProject(Request $request){

        $data = request()->validate([
            'kategoriProject' => 'required|max:50'
        ]);
 
        DB::table('project')
            ->insert([
                'kategoriProject' => $request->kategoriProject,
            ]);

    }

    public function editKategoriProject($id){

        $project=DB::table('project')
                ->where('id', $id)
                ->first();

        return view('admin/project/editproject', compact('project'));
    }

     public function updateKategoriProject(Request $request){
            // dd($request);
 
            $data = request()->validate([
                'kategoriProject' => 'required|max:100',
            ]);
 
            DB::table('project')
                ->where('id', $request->idProject)
                ->update([
                    'kategoriProject' => $request->kategoriProject,
                ]);

            return redirect('/admin/kategori-project');
    }
 
    public function deleteKategoriProject(Request $request){
 
        $KategoriProject = DB::table('project')
                ->where('id', $request->id)
                ->first();
 
        DB::table('project')
            ->where('id', $request->id)
            ->delete();

        return redirect(url()->previous());
    }

    //PROJECT 
    public function project(){

        $data = DB::table('subproject')
            ->get();

        $subProject=DB::table('project')
            ->get();

        return view('admin.subproject.subproject', compact('data', 'subProject'));
    }

    public function insertProject(Request $request){

        $data = request()->validate([
            'namaCluster' => 'required|max:100',
            'kotaCluster' => 'required|max:100',
            'luasCluster' => 'required|max:50',
            'idKategoriProject' => 'required'
        ]);
 
        DB::table('subproject')
            ->insert([
                'namaCluster' => $request->namaCluster,
                'kotaCluster' => $request->kotaCluster,
                'luasCluster' => $request->luasCluster,
                'idProject' => $request->idKategoriProject
            ]);

        $maks = DB::table('subproject')
            ->max('id');

        $project = DB::table('subproject')
            ->where('id', $maks)
            ->first();

        $file = $request->file('photoCluster');
        if($file != null) {
            $name= 'photoCluster' . $project->id . '.' . $file->getClientOriginalExtension();
            $tujuan='images/project';
            $file->move($tujuan, $name);

            DB::table('subproject')
                ->where('id', $maks)
                ->update([
                    'photoCluster' => $name
                ]);
        }
    }

    public function editProject($id){

        $project=DB::table('subproject')
                ->where('id', $id)
                ->first();

        $data=DB::table('project')
                ->get();

        return view('admin/subproject/editsubproject', compact('project', 'data'));
    }

     public function updateProject(Request $request){
            // dd($request);
 
            $data = request()->validate([
                'namaCluster' => 'required|max:100',
                'kotaCluster' => 'required',
                'luasCluster' => 'required',
                'idKategoriProject' => 'required',
            ]);

            DB::table('subproject')
                ->where('id', $request->idSubProject)
                ->update([
                    'namaCluster' => $request->namaCluster,
                    'kotaCluster' => $request->kotaCluster,
                    'luasCluster' => $request->luasCluster,
                    'idProject' => $request->idKategoriProject,
                ]);
 
            $file=$request->file('photoCluster');
            if ($file != null) {
 
                $name='photoCluster' . $request->idSubProject . '.' . $file->getClientOriginalExtension();
                if(File::exists(public_path('images/project/. $name .'))){
                    File::delete(public_path('images/project/. $name .'));
                    $tujuan='images/project';
                    $file->move($tujuan, $name);
                }else{
                    $tujuan='images/project';
                    $file->move($tujuan, $name);
                }

                DB::table('subproject')
                ->where('id', $request->idSubProject)
                ->update([
                    'photoCluster' => $name,
                ]);
 
            }

            return redirect('/admin/project');
    }
 
    public function deleteProject(Request $request){
 
        $project = DB::table('subproject')
                ->where('id', $request->id)
                ->first();
 
        File::delete('images/project/'.$project->photoCluster);

        DB::table('subproject')
            ->where('id', $request->id)
            ->delete();

        return redirect(url()->previous());
    }
}