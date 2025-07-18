@section('js')
    @parent
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('budgetForm', () => ({
                items: @json(old('items', $items)),
                description: null,
                price: null,
                errors: {},
                loading: false,
                get total() {
                    const total = this.items.reduce((acc, item) => acc + parseFloat(item.price), 0);
                    return total.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    });
                },
                async addItem() {
                    try {
                        this.loading = true;

                        const result = await axios.post('/api/budget-items', {
                            items: [{
                                description: this.description,
                                price: this.price,
                            }, ...this.items]
                        });

                        this.items.push({
                            description: this.description,
                            price: this.price,
                        });
                        this.description = null;
                        this.price = null;

                    } catch (error) {
                        if (error.status == 422) {

                            this.errors = await error.response.data.errors;

                            console.log(this.errors['items.0.description']);
                        }

                    } finally {
                        this.loading = false;
                    }
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                },
            }));
        });
        document.addEventListener('DOMContentLoaded', () => {
            const remove = SimpleMaskMoney.setMask('#price');
            // remove();
        });
    </script>
@endsection
