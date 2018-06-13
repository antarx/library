<template>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5" v-for="item in items">
            <div class="thumb mb-3">
                <img class="img-fluid" src="@{{ item.image }}">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchAll();
        },
        data() {
            return {
                items: [],
                pagination: [],
                back: ''
            }
        },
        methods: {
            fetchAll() {
                var self = this;

                axios.get('http://library.loc/admin/filemanager').then(function (response) {
                    console.log(response);

                    self.items = response.items;
                    self.pagination = response.pagination;
                    self.back = response.back;
                });
            }
        }
    }
</script>