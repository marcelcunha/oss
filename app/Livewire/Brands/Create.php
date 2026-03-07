<?php

namespace App\Livewire\Brands;

use App\Enums\BrandCategoryEnum;
use App\Services\BrandService;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;

    public ?array $categories = null;

    public string $name = '';

    public string $title = 'Criar Marca';

    #[Computed()]
    public function categoriesForSelect(): array
    {
        return Arr::map(BrandCategoryEnum::cases(), fn (BrandCategoryEnum $category) => [
            'value' => $category->value,
            'label' => $category->label(),
        ]);
    }

    public function render()
    {
        return view('livewire.brands.create');
    }

    public function save(BrandService $service)
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'categories' => ['required', 'array'],
            'categories.*' => ['string', Rule::enum(BrandCategoryEnum::class)],
        ]);

        $this->toast()->success('Marca criada com sucesso!')->flash()->send();
        $this->resetExcept('title');
        $this->redirectRoute('brands.index');
    }
}
