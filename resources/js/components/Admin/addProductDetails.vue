<template>
    <form class="forms-sample" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="name"
                   placeholder="Enter your product name" v-model="name">
        </div>
        <div class="form-group">
            <label for="category">Product Category <span class="text-danger">*</span></label>
            <select class="form-control js-example-basic-single w-100" id="category" name="category" v-model="category">
                <option value="">Select a category</option>
                <option v-for="category in categories" :value="category.id">{{ category.categoryName }}</option>
            </select>
        </div>
        <div>
            <div class="row" v-for="(item, index) in items" :key="index">
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Select Color <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control js-example-basic-single w-100" :id="'color' + index" :name="'color' + index" v-model="item.color">
                                <option value="">Select a color</option>
                                <option v-for="color in colors" :value="color.id">{{ color.color }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Select Size <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control js-example-basic-single w-100" :id="'size' + index" :name="'size' + index" v-model="item.size">
                                <option value="">Select a color</option>
                                <option v-for="size in sizes" :value="size.id">{{ size.size }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Quantity <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" :id="'quantity' + index" :name="'quantity' + index" v-model="item.quantity"
                                   placeholder="Enter product quantity">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-success me-2" @click="addItem"><i class="bi bi-plus"></i></button>
                    <button type="button" class="btn btn-danger" v-if="index > 0" @click="deleteItem(index)"><i class="bi bi-dash-lg"></i></button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Product Photos <span class="text-danger">*</span></label>
            <input type="file" name="image[]" class="file-upload-default" multiple>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Images">
                <span class="input-group-append"><button class="file-upload-browse btn btn-primary" type="button">Upload</button></span>
            </div>
        </div>
        <div class="form-group">
            <label for="details">Caption</label>
            <textarea class="form-control" id="details" name="details" rows="4"
                      placeholder="Write details about this product (Optional)" v-model="caption"></textarea>
        </div>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            colors: [],
            sizes: [],
            category: '',
            name: '',
            items: [
                { color: '', size: '', quantity: '' }
            ]
        };
    },
    mounted() {
        this.fetchCategoryNames();
        this.fetchColors();
        this.fetchSizes();
    },
    methods: {
        async fetchCategoryNames() {
            try {
                const response = await axios.get('/api/product-category');
                console.log(response.data)
                this.categories = response.data;
            } catch (error) {
                console.error('Error fetching category names:', error);
            }
        },
        async fetchColors() {
            try {
                const response = await axios.get('/api/product-color');
                console.log(response.data)
                this.colors = response.data;
            } catch (error) {
                console.error('Error fetching colors:', error);
            }
        },
        async fetchSizes() {
            try {
                const response = await axios.get('/api/product-size');
                console.log(response.data)
                this.sizes = response.data;
            } catch (error) {
                console.error('Error fetching sizes:', error);
            }
        },
        addItem() {
            this.items.push({ color: '', size: '', quantity: '' });
        },
        deleteItem(index) {
            this.items.splice(index, 1);
        },
    }
};
</script>

<style scoped>

</style>
