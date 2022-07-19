<template>
    <div class="container-login100">
        <div class="wrap-login100 wrap-forget100">
            <div class="login100-pic js-tilt" data-tilt>
                <img :src="require(`/images/img-01.png`)" alt class="icon" />
            </div>

            <form class="login100-form validate-form" @submit.prevent="sendMail" method="post">
					<span class="login100-form-title text-danger">
						Member Forget Password
					</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email" v-model="form.email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>
                <span class="text-danger" v-if="errors && errors.email"> {{ errors.email[0]}}</span>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Send mail
                    </button>
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
        sendMail() {
            this.errors = {};
            axios.post(this.$apiLocation.RESET_PASSWORD(), this.form)
                .then((res) => {
                    if(res.data.errors) {
                        this.$toast.error(res.data.errors);
                    } else {
                        this.$toast.success(res.data.message);
                    }

                    })
                .catch((res) => {
                    console.log(res);
                })
        }
    }
}
</script>

<style scoped>

</style>
