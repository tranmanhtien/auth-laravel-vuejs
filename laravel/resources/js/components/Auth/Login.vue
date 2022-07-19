<template>
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <!--                <img src="images/img-01.png" alt="IMG">-->
                <img :src="require(`/images/img-01.png`)" alt class="icon"/>
            </div>

            <form class="login100-form validate-form" @submit.prevent="loginForm" method="post">
                    <input type="hidden" name="_token" :value="form._token">
					<span class="login100-form-title text-danger">
						Member Login
					</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email" v-model="form.email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.email"> {{ errors.email[0] }}</span>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="pass" placeholder="Password" v-model="form.password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.password"> {{ errors.password[0] }}</span>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
                    <a class="txt2" :href="this.$apiLocation.FORGET_PASSWORD()">
                        Username / Password?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" :href="this.$apiLocation.REGISTER()">
                        Create your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            form: {
               _token : document.head.querySelector('meta[name="csrf-token"]').content
            },
            errors: {},
        }
    },
    methods: {
        loginForm() {
            this.errors = {};
            axios.post(this.$apiLocation.LOGIN(), this.form).then(res => {
                if(res.data.status == this.$statusCode.UNAUTHORIZED)
                {
                    this.$toast.error(res.data.message)
                } else {
                    window.location.href = this.$apiLocation.DASHBOARD();
                }
                }
            )
        }
    }
}
</script>

<style scoped>

</style>
