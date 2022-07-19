<template>
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img :src="require(`/images/img-01.png`)" alt="IMG">
            </div>

            <form class="login100-form validate-form" @submit.prevent="changePass" method="post">
                <input type="hidden" name="token" v-model="form.token">
                <input type="hidden" name="email" v-model="form.email">
                <span class="login100-form-title text-danger">
						Member Reset PassWord
					</span>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="New Password"
                           v-model="form.password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.password"> {{ errors.password[0] }}</span>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password_confirmation" placeholder="Re-Password"
                           v-model="form.password_confirmation">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger"
                      v-if="errors && errors.password_confirmation"> {{ errors.password_confirmation[0] }}</span>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Change
                    </button>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="/login">
                        Login your Account
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
    props: ['token', 'email'],
    data() {
        return {
            form: {
                token_url: this.token,
                email_url: this.email
            },
            errors: {},
        }
    },
    methods: {
        changePass() {
            this.errors = {};
            axios.post(this.$apiLocation.CHANGE_PASSWORD(), this.form)
                .then((res) => {
                    console.log(res.data.status);
                    if(res.data.status == this.$statusCode.UNAUTHORIZED) {
                        this.$toast.error(res.data.message);
                    } else {
                        this.$toast.success(res.data.message);
                    }
                })
                .catch((res) => {
                    console.log(res);
                    if (res.response.data.errors) {
                        this.errors = res.response.data.errors;
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
