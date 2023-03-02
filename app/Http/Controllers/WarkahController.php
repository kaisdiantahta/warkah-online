<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warkah;
class WarkahController extends Controller
{
    // Show full data
    public function index()
    {
        $warkahs = Warkah::get();

        return view('warkah.index',compact('warkahs'));
    }

    //layout to create data
    public function create()
    {
        return view('warkah.create');
    } 

    //Store data to database
    public function store(Request $request)
    {

        $request->validate([ 
            'nomor_akta' => 'required',
            'nama_pihak1' => 'required',
            'nama_pihak2' => 'required',
            'rincian' => 'required',
            'alamat' => 'required',
            'nominal_transaksi'=>'required',
            'file'=>'required'

        ]);
       
        try {
             $file = $request->file('file');
            $nama_file =$file->getClientOriginalName();
            $nama_file_manipulated = time()."_".$file->getClientOriginalName();
            $file->move('data_file',$nama_file_manipulated);
       
            Warkah::create([
                'nomor_akta' => $request->nomor_akta,
                'nama_pihak1' => $request->nama_pihak1,
                'nama_pihak2' => $request->nama_pihak2,
                'rincian' => $request->rincian,
                'alamat' => $request->alamat,
                'nominal_transaksi' => $request->nominal_transaksi,
                'file' => $nama_file_manipulated,
                'nama_file' => 'data_file'.$nama_file,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }

        return redirect()->route('warkah.index')->with('message', '<div class="alert alert-success my-3">Data buku berhasil ditambahkan.</div>');
    }

    //form to search warkah
    public function show()
    {
        return view('warkah.show');
    }
    

    //Prossess search data warkah & show document
    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'akta'=> 'required'
        ]);

        try {
             $warkah = Warkah::where('nomor_akta', 'like', '%' . $request->akta . '%')
                            ->Where('nama_pihak1', 'like', '%' . $request->name . '%')
                            ->orWhere('nama_pihak2', 'like', '%' . $request->name . '%')
                            ->Get();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }
        if (count($warkah)>0){
            
        $redirect =redirect()->back()->with('file',$warkah)->with('param',"true");
        }else{
        $redirect = redirect()->back()->with('message', '<div class="alert alert-danger my-3"> Data Not Found</div>');
       
        }
        return $redirect;
    }
    public function edit($id)
    {
        try{
            $warkah = Warkah::where('id', $id)->first();
            
        }catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }
        
        return view('warkah.edit',compact('warkah'));
    }
    public function detail($id)
    {
        try{
            $warkah = Warkah::where('id', $id)->first();
            
        }catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }
        
        return view('warkah.detail',compact('warkah'));
    }
     public function add_komentar(Request $request,$id)
    {
        $warkah = Warkah::find($id);
        $warkah->komentar= $request->komentar;        
        $warkah->save();
        return redirect()->route('warkah.index')->with('message', '<div class="alert alert-success my-3">Komentar Berhasil Diberikan</div>');
    }
    public function update(Request $request,$id)
    {
          $request->validate([
            'nomor_akta' => 'required',
            'nama_pihak1' => 'required',
            'nama_pihak2' => 'required',
            'rincian' => 'required',
            'alamat' => 'required',
            'nominal_transaksi'=>'required'

        ]);
        try{
             $file = $request->file('file');
            if (!empty($file)){
                $nama_file =$file->getClientOriginalName();
                $nama_file_manipulated = time()."_".$file->getClientOriginalName();
                $file->move('data_file',$nama_file_manipulated);
            } 
            $warkah = Warkah::find($id);
                $warkah->nomor_akta= $request->nomor_akta;
                $warkah->nama_pihak1= $request->nama_pihak1;
                $warkah->nama_pihak2= $request->nama_pihak2;
                $warkah->rincian= $request->rincian;
                $warkah->alamat= $request->alamat;
                $warkah->nominal_transaksi= $request->nominal_transaksi;
                if (!empty($file)){
                    $warkah->file= $nama_file_manipulated;
                    $warkah->nama_file= $nama_file;
                }
                $warkah->save();
            
        }catch (\Exception $e) {
            return $e;
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }
        
        return redirect()->route('warkah.index')->with('message', '<div class="alert alert-success my-3">Data Berhasil diubah.</div>');
    }

     public function delete($id)
    {
        try{
            $warkah = Warkah::where('id', $id)->first();
            $warkah->delete();
        
        }catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }
        
        return redirect()->back()->with('message', '<div class="alert alert-success my-3">Dokumen berhasil dihapus.</div>');
    }
}
