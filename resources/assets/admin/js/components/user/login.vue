<template>
   <div class="login-body">
       <div class="login-form" v-loading="loading">
           <el-row>
               <el-col :span="24">
                   <h3 class="text-center text-info mb-3">Blog 后台</h3>
                   <el-form label-position="right" label-width="80px" :model="loginForm" ref="loginForm" :rules="loginRules">
                       <el-form-item label="用户名：" prop="email">
                           <el-input v-model="loginForm.email" placeholder="请输入用户名"></el-input>
                       </el-form-item>
                       <el-form-item label="密码：" prop="pass">
                           <el-input type="password" v-model="loginForm.pass" placeholder="请输入密码"></el-input>
                       </el-form-item>
                       <el-form-item>
                           <el-button type="primary" @click="submitLogin('loginForm')">登陆</el-button>
                           <el-button @click="resetLogin('loginForm')">取消</el-button>
                       </el-form-item>
                   </el-form>
               </el-col>
           </el-row>
       </div>
   </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                loginForm: {
                    email: '',
                    pass: ''
                },
                loginRules: {
                    email: [
                        {required: true, message: '请输入用户名', trigger: 'blur'},
                        {type: 'email', message: '用户名格式不正确', trigger: 'blur'}
                    ],
                    pass: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                        {min:6, max: 10, message: '密码长度应该在6-10个之间', trigger: 'blur'}
                    ]
                }
            };
        },
        methods: {
            submitLogin(loginForm) {
                let _this = this;
                let _duration = 1000;
                _this.$refs[loginForm].validate((valid) => {
                    if(valid) {
                        _this.loading = true;
                        window.axios.post('/user/login', _this.loginForm).then(function (response) {
                            let data = response.data;
                            if( data.status === 200 ) {
                                sessionStorage.setItem('login', JSON.stringify(data.user));
                                _this.$message({
                                    message: data.message,
                                    type:'success',
                                    duration: _duration
                                });
                                setTimeout(function () {
                                    // 在 Vue 实例内部，你可以通过 $router 访问路由实例。因此你可以调用 this.$router.push。想要导航到不同的 URL，则使用 router.push 方法。这个方法会向 history 栈添加一个新的记录，所以，当用户点击浏览器后退按钮时，则回到之前的 URL。
                                    _this.$router.push({path: '/index'});
                                }, _duration);
                            }else {
                                _this.$message('错了哦，这是一条错误消息');
                                _this.$message.error(data.message);
                                _this.loading = false;
                            }
                        }).catch(function (error) {
                            _this.loading = false;
                            console.log(error);
                        });
                    }else {
                        console.log('Valid Error.');
                        return false;
                    }
                });
            },
            resetLogin(loginForm) {
                this.$refs[loginForm].resetFields();
            }
        }
    }
</script>

<style type="text/css">
    body{
        background: #324057;
        color: #FFF;
    }
    .login-form {
        width: 400px;
        padding: 50px;
        margin: 13% auto 0 auto;
        background-color: #ffffff;
        border-radius: 5px;
    }
</style>
