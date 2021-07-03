<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class Create extends Component
{
    use WithFileUploads;

    public $name, $price, $description, $thumbnail;

    public function save()
    {
        $validate = $this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'thumbnail' => 'image|max:1024'
        ]);

        $validate['thumbnail'] = $this->thumbnail->store('photos');

        Product::create($validate);
        return redirect('');
    }

    public function render()
    {
        return view('livewire.product.create')->extends('layouts.app');
    }
}
