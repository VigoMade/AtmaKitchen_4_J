<?php

namespace App\Http\Controllers;

use App\Models\Penitip;
use App\Models\Produk;
use App\Models\Resep;
use Exception; // Pastikan menggunakan use Exception di atas namespace
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $produk = Produk::orderBy('id_produk', 'desc')->paginate(5);
        return view('AdminProduk.indexProduk', compact('produk'));
    }

    /** 
     * create
     *
     * @return void
     */
    public function create()
    {
        $penitip = Penitip::all();
        $resep = Resep::all();
        return view('AdminProduk.createProduk', compact('penitip', 'resep'));
    }


    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'harga_produk' => 'required',
            'satuan_produk' => 'required',
            'jenis_produk' => function ($attribute, $value, $fail) use ($request) {
                if ($request->id_penitip == null && empty ($value)) {
                    $fail('The ' . $attribute . ' field is required.');
                }
            },
            'image' => 'image|mimes:jpeg,jpg,gif,svg,png|max:2048',
        ]);

        $input = $request->all();

        $nullableColumns = [
            'id_penitip',
            'id_resep',
            'stock_produk',
            'tanggal_mulai_po',
            'tanggal_selesai_po',
            'kuota',
            'status',
            'image'
        ];

        foreach ($nullableColumns as $column) {
            if (empty($input[$column])) {
                $input[$column] = null;
            }
        }

        if ($request->id_penitip == null) {
            $this->validate($request, [
                'jenis_produk' => 'required',
            ]);
        }

        if ($image = $request->file('image')) {
            $destinationPath = 'public/images';
            $fotoProduk = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $fotoProduk);
            $input['image'] = 'images/' . $fotoProduk;
        }
        if ($request->id_penitip != null) {
            $pentip = Penitip::find($request->id_penitip);
            $input['jenis_produk'] = $pentip->jenis_produk_penitip;
            ;
        }

        try {
            Produk::create($input);
            return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('produks.index')->with('error', $e->getMessage());
        }
    }


    /**
     * edit
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $penitip = Penitip::all();
        $resep = Resep::all();
        $produk = Produk::find($id);
        return view('AdminProduk.editProduk', compact('penitip', 'resep', 'produk'));
    }

    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $this->validate($request, [
            'harga_produk' => 'required',
            'jenis_produk' => function ($attribute, $value, $fail) use ($request) {
                if ($request->id_penitip == null && empty ($value)) {
                    $fail('The ' . $attribute . ' field is required.');
                }
            },
            'satuan_produk' => 'required',
            'image' => 'image|mimes:jpeg,jpg,gif,svg,png|max:2048',
        ]);

        $input = $request->all();

        $nullableColumns = [
            'id_penitip',
            'id_resep',
            'stock_produk',
            'tanggal_mulai_po',
            'tanggal_selesai_po',
            'kuota',
            'status',
        ];

        foreach ($nullableColumns as $column) {
            if (empty($input[$column])) {
                $input[$column] = null;
            }
        }

        $input = $request->all();
        if ($image = $request->file('image')) {
            if ($produk->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $produk->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $produk->image)));
            }

            $destinationPath = 'public/images';
            $fotoProduk = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $fotoProduk);
            $input['image'] = 'images/' . $fotoProduk;
        } else {
            unset($input['image']);
        }

        if ($request->id_penitip == null) {
            $this->validate($request, [
                'jenis_produk' => 'required',
            ]);
        }

        if ($request->id_penitip != null) {
            $pentip = Penitip::find($request->id_penitip);
            if ($pentip != null) {
                return redirect()->route('produks.index')->with('error', 'Jenis produk tidak dapat diubah menjadi Produk Toko jika terdapat Produk penitip.');
            }
            $input['jenis_produk'] = $pentip->jenis_produk_penitip;
        }


        try {
            $produk->update($input);
            return redirect()->route('produks.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (Exception $e) {
            return redirect()->route('produks.index')->with('error', $e->getMessage());
        }
    }
    /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->route('produks.index')->with([
            'success' => 'Data 
            Berhasil Dihapus!'
        ]);
    }


    public function show(Request $request)
    {
        $search = $request->search;

        $produk = Produk::where('nama_produk', 'like', "%" . $search . "%")
            ->orWhereHas('penitips', function ($query) use ($search) {
                $query->where('nama_produk_penitip', 'like', "%" . $search . "%");
            })
            ->paginate(5);

        return view('AdminProduk.indexProduk', compact('produk'));
    }


    public function search(Request $request)
    {
        $search = $request->search;

        $produk = Produk::where('nama_produk', 'like', "%" . $search . "%")
            ->orWhereHas('penitips', function ($query) use ($search) {
                $query->where('nama_produk_penitip', 'like', "%" . $search . "%");
            })
            ->paginate(5);

        return view('AdminProduk.indexProduk', compact('produk'));
    }
}
