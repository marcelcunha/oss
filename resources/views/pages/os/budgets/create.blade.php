<x-pages.upsert title='Novo Orçamento'>
    <x-form action="{{ route('budgets.store') }}" cancelRoute="{{ route('budgets.index') }}" id='budget-form'>
        <div class="grid gap-x-4 gap-y-6 lg:grid-cols-3 2xl:grid-cols-3">
            <x-input-text label='Cliente' readonly value="{{ $checkin->client->name }}" />
            <x-input-text label='Equipamento' readonly value="{{ $checkin->device->name }}" />
            <x-input-text label='Data do Orçamento' name='budget_date' required type='date'
                value="{{ old('budget_date', today()) }}" />

            <x-textarea label='Anotações' name='notes' parent-class='col-span-3 mb-6' value="{{ old('notes') }}" />
        </div>

        <x-card label='Ítens do Orçamento' x-data="budgetForm()">

            <div class='grid gap-x-4 lg:grid-cols-[3fr_1fr_auto]'>

                <div class="flex flex-col">
                    <x-label for="description" name='description' value="Descrição *" />
                    <div class='mt-2 flex'>
                        <x-input ::class="{ 'border-red-500': errors.hasOwnProperty('description') }" id="description" x-model="description" />
                    </div>

                    <template x-if="errors.hasOwnProperty('description')">
                        <template x-for="error in errors.description">
                            <div class="mt-1 text-xs text-red-500" x-text='error'></div>
                        </template>
                    </template>
                </div>

                <div class="flex flex-col">
                    <x-label for="price" value="Preço *" />
                    <div class='mt-2 flex'>
                        <x-input ::class="{ 'border-red-500': errors.hasOwnProperty('price') }" id="price" name='price' x-model="price" />
                    </div>
                    <template x-if="errors.hasOwnProperty('price')">

                        <template x-for="error in errors.price">
                            <div class="mt-1 text-xs text-red-500" x-text='error'></div>
                        </template>
                    </template>
                </div>

                <div class='flex items-end justify-center'>
                    <x-button @click='addItem()' class='h-11' color='secondary' id='items_button'>Adicionar</x-button>
                </div>
            </div>

            <div class="mt-6">
                <x-table :border-red="$errors->has('items')" :columns="['Descrições', 'Preços', 'Ação']" border>
                    <template x-for="(item, index) in items">
                        <tr :key="index">
                            <td class="p-2" x-text='item.description'>

                            </td>
                            <td class="p-2" x-text='item.price'>
                            </td>
                            <td class="whitespace-nowrap">
                                <x-button ::disabled="loading" @click="removeItem(index)" btn='btn-xs' class="h-7 w-7"
                                    color=secondary>
                                    <x-heroicon-o-trash class="text-gray-300" />
                                </x-button>
                            </td>
                        </tr>
                    </template>
                    <template x-if='items.length == 0'>
                        <tr>
                            <td class="p-2 text-center" colspan='3'>Não há itens registrados</td>
                        </tr>
                    </template>
                    <x-slot:footer>
                        <template x-if='items.length != 0'>
                                <tr class='text-left'>
                                    <th class='p-2'>Total:</th>
                                    <th class='p-2' x-text='total'></th>
                                </tr>
                        </template>
                    </x-slot:footer>

                </x-table>
                @error('items')
                    <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <template :key="index" x-for="(item, index) in items">
                <div>
                    <input :name="'items[' + index + '][description]'" :value="item.description" type="hidden" />
                    <input :name="'items[' + index + '][price]'" :value="item.price" type="hidden" />
                </div>
            </template>
            <input name='checkin_id' type="hidden" value="{{ $checkin->id }}" />
        </x-card>
    </x-form>

    @include('pages.os.budgets.budget-form-script', ['items' => []])

</x-pages.upsert>
