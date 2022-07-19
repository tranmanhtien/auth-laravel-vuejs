<template>
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img :src="require(`/images/img-01.png`)" alt="IMG">
            </div>

            <form class="login100-form validate-form" @submit.prevent="registerForm" method="post">
					<span class="login100-form-title text-danger">
						Member Register
					</span>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="name" placeholder="Name" v-model="form.name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.name"> {{ errors.name[0]}}</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email" v-model="form.email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.email"> {{ errors.email[0]}}</span>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" v-model="form.password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.password"> {{ errors.password[0]}}</span>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password_confirmation" placeholder="Re-Password" v-model="form.password_confirmation">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.password_confirmation"> {{ errors.password_confirmation[0]}}</span>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Register
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
    data() {
        return {
            form: {
            },
            errors: {}
        }
    },
    methods: {
        registerForm() {
            this.errors = {};
            axios.post(this.$apiLocation.REGISTER(), this.form)
                .then((res) => {
                    // window.location.href = this.$apiLocation.LOGIN()
                    this.$toast.success('Register success');
                    })
                .catch((res) => {
                    if(res.response.data.errors){
                        this.errors = res.response.data.errors;
                    }
                })
        }
    }
}
</script>

<style scoped>

</style>
