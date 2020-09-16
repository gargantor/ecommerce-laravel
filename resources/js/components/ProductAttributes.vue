<template>
    <div>
        <div class="tile">
            <h3 class="tile-title">Attributes</h3>
            <hr>
            <div class="tile-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent">Select an Attribute <span class="m-l-5 text-danger"> *</span></label>
                            <select id="parent" class="form-control custom-select mt-15" v-model="attribute" @change="selectAttribute(attribute)">
                                <option :value="attribute" v-for="attribute in attributes">{{ attribute.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile" v-if="attributeSelected">
            <h3 class="tile-title">Add Attributes to Product</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="values">Select a value <span class="m-l-5 text-danger"> *</span></label>
                        <select id="values" class="form-control custom-select mt-15" v-model="value" @change="selectValue(value)">
                            <option :value="value" v-for="value in attributeValues">{{ value.value }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" v-if="valueSelected">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quantity" class="control-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" v-model="currentQty" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="price" class="control-label">Price</label>
                        <input type="number" class="form-control" id="price" v-model="currentPrice" />
                        <small class="text-danger">this price will be added to the main price of product on frontend.</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary" @click="addProductAttribute()">
                        <i class="fa fa-plus"></i>Add
                    </button>
                </div>
            </div>
        </div>
        <div class="tile">
            <h3 class="tile-title">Product Attributes</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-center">
                                <th>Value</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pa in productAttributes">
                                <td style="width: 25%" class="text-center">{{ pa.value}}</td>
                                <td style="width: 25%" class="text-center">{{ pa.quantity}}</td>
                                <td style="width: 25%" class="text-center">{{ pa.price}}</td>
                                <td style="width: 25%" class="text-center">
                                    <button class="btn btn-sm btn-danger" @click="deleteProductAttribute(pa)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'product-attributes',
    props: ['productid'],
    data() {
        return {
            productAttributes: [],
            attributes: [],
            attribute: {},
            attributeSelected: false,
            attributeValues: [],
            value: {},
            valueSelected: false,
            currentAttributeId: '',
            currentValue: '',
            currentQty: '',
            currentPrice: '',
        }
    },
    created: function(){
        this.loadAttributes();
        this.loadProductAttributes(this.productid);
    },
    methods: {
        loadProductAttributes(id) {
            let _this = this;
            axios.post('/admin/products/attributes', {
                id: id
            }).then((response) => {
                _this.productAttributes = response.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        loadAttributes(){
            let _this = this
            axios.get('/admin/products/attributes/load').then (function(response){
                _this.attributes = response.data;
            }).catch(function(err){
                console.log(err);
            });
        },
        selectAttribute(attribute) {
            let _this = this;
            this.currentAttributeId = attribute.id;
            axios.post('/admin/products/attributes/values', {
                id: attribute.id
            }).then((response) => {
                _this.attributeValues = response.data;
            }).catch((err) => {
                console.log(err);
            });
            this.attributeSelected=true;
        },
        selectValue(value) {
            this.valueSelected = true;
            this.currentValue = value.value;
            this.currentQty = value.quantity;
            this.currentPrice = value.price;
        },
        addProductAttribute() {
            if (this.currentQty === null || this.currentPrice === null) {
                this.$swal("Error, Some values are missing.", {
                    icon: "error",
                });
            } else {
                let _this = this;
                let data = {
                    attribute_id: this.currentAttributeId,
                    value: this.currentValue,
                    quantity: this.currentQty,
                    price: this.currentPrice,
                    product_id: this.productid,
                };

                axios.post('/admin/products/attributes/add', {
                    data: data
                }).then((response) => {
                    _this.$swal("Success!" + response.data.message, {
                        icon: "success",
                    });
                    _this.valueSelected = false;
                    _this.currentValue = '';
                    _this.currentQty = '';
                    _this.currentPrice = '';
                }).catch((err) => {
                    console.log(err);
                });
                this.loadProductAttributes(this.productid);
            }
        },
        deleteProductAttribute(pa) {
            let _this = this;
            this.$swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willdelete) => {
                if(willdelete){
                    console.log(pa.id);
                    axios.post('/admin/products/attributes/delete', {
                        id: pa.id,
                    }).then((response) => {
                        if (response.data.status === 'success') {
                            _this.$swal("Success! Product attribute has been deleted!", {
                                icon: "success",
                            });
                            this.loadProductAttributes(this.productid);
                        } else {
                            _this.$swal("Your Product attribute not deleted!");
                        }
                    }).catch((err) => {
                        console.log(err);
                    });
                } else {
                    this.$swal("Action cancelled!");
                }
            });
        }

    }
}
</script>
