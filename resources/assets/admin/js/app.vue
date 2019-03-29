<template>
    <div id="app">
        <!-- 路由匹配到的组件将渲染在这里 -->
        <router-view></router-view>
    </div>
</template>
<style type="text/css">

</style>
<script type="text/ecmascript-6">
    export default{
        name: 'app',
        watch: {
            '$route'(to, from) { //监听路由改变
                if(to.path !== '/login') {
                    this.authLogin();
                }
            }
        },
        methods: {
            authLogin: function () {
                let _this = this;
                let user = JSON.parse(sessionStorage.getItem('login'));
                if (!user) {
                    _this.$router.push({path: 'login'});
                }
                window.axios.post('/user/check').then(function (response) {
                    if ( response.data ) {
                        sessionStorage.removeItem('login');
                        _this.$router.push({path: '/login'});
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        created: function () {
            this.authLogin();
        }
    }
</script>