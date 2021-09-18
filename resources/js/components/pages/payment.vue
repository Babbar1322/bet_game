<template>
    <div>
        <b-container>
            <b-row>
                <b-col md="3"></b-col>
                <b-col md="6" class="pl-0 pr-0">
                    <b-card class="bg-royalblue mh">
                        <b-row>
                            <b-col cols="6" class="text-white">
                                <router-link to="/wallet">
                                    <b-icon
                                        icon="chevron-left"
                                        class="h3 text-white"
                                        @click="back"
                                /></router-link>
                                <span style="position:relative;bottom:10px;">
                                    Payments
                                </span>
                            </b-col>
                            <b-col cols="6"></b-col>
                        </b-row>
                        <b-container class="mt-5">
                            <div class="text-warning">
                                Step 1 : Copy UPI Information
                            </div>
                            <label class="text-white">Amount</label>
                            <b-input-group class="mb-3">
                                <input
                                    type="text"
                                    class="form-control cstmform"
                                    v-model="form.amount"
                                />
                                <b-input-group-append>
                                    <b-button
                                        variant="primary"
                                        v-clipboard="value"
                                        >Copy</b-button
                                    >
                                </b-input-group-append>
                            </b-input-group>
                            <label class="text-white">UPI Account</label>
                            <b-input-group class="mb-3">
                                <input
                                    type="text"
                                    class="form-control cstmform"
                                    v-model="form.upi"
                                />
                                <b-input-group-append>
                                    <b-button
                                        variant="primary"
                                        v-clipboard="value1"
                                        >Copy</b-button
                                    >
                                </b-input-group-append>
                            </b-input-group>
                            <div class="text-warning">
                                Step 2 : Open online banking or wallet ,
                                transfer to the UPI account
                            </div>
                            <div class="text-white">
                                <small>transfer the money to UPI account</small>
                            </div>
                            <div class="text-danger">
                                <small
                                    >the UPI account may change any time.Please
                                    do not save the UPI account</small
                                >
                            </div>
                            <div class="text-warning">
                                Step 3 : Enter Ref No.
                            </div>
                            <div class="text-white">
                                <small
                                    >check the UPI reference no. after payment
                                    from your UPI app Example in below
                                    image</small
                                >
                            </div>

                            <input
                                type="text"
                                class="form-control cstmform"
                                placeholder="REF NO."
                                v-model="form.refno"
                                v-on:blur="handleRef"
                            />
                            <small class="text-danger"
                                >*Please enter Ref No. to complete to
                                recharge.</small
                            >
                            <div class="text-center mt-3">
                                <Button shape="circle" @click="modal"
                                    >Confirm REF No.</Button
                                >
                            </div>
                        </b-container>
                    </b-card>
                </b-col>
                <b-col md="3"></b-col>
            </b-row>
        </b-container>
        <Modal v-model="modal1">
            <div class="text-center">
                <p>Amount:{{ form.amount }}</p>
                <p>UPI Account:{{ form.upi }}</p>
                <p>Ref No.:{{ form.refno }}</p>
            </div>

            <div slot="footer">
                <Button shape="circle" @click="pay" :loading="loading"
                    >PAY</Button
                >
            </div>
        </Modal>
    </div>
</template>

<script>
export default {
    data() {
        return {
            error: "",
            user_id: "",
            loading: false,
            modal1: false,
            form: {
                amount: this.$route.params.amount,
                upi: "abc123@upi",
                refno: ""
            }
        };
    },
    created() {
        axios
            .get("/api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                if (res.data[0] == "token_expired") {
                    this.auth = "";
                    this.$router.push("/login");
                }
                this.user_id = res.data.user.id;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        back() {
            localStorage.setItem("path", "/wallet");
        },
        value() {
            this.i("link copied");
            return this.form.amount;
        },
        value1() {
            this.i("link copied");
            return this.form.upi;
        },
        handleRef() {
            axios
                .post("/api/payment/" + this.user_id, {
                    refno: this.form.refno
                })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                    if (err.response.data) {
                        this.i(err.response.data.res);
                        this.error = err.response.data.res;
                    }
                });
        },
        modal() {
            if (this.form.refno == "") {
                this.i("please enter refernce no.");
            } else if (this.error != null) {
                // this.i(this.error);
            } else {
                this.modal1 = true;
            }
        },
        pay() {
            this.loading = true;
            axios
                .post("/api/payment/" + this.user_id, {
                    amount: this.form.amount,
                    upi: this.form.upi,
                    refno: this.form.refno
                })
                .then(res => {
                    console.log(res);
                    this.loading = false;
                    this.modal1 = false;

                    this.s("payment request sent to admin");
                    this.$router.push("/wallet");
                    localStorage.setItem("path", "/wallet");
                })
                .catch(err => {
                    this.loading = false;
                    this.modal1 = false;
                    this.e(err.response.data.message);
                    this.$router.push("/wallet");
                });
        }
    }
};
</script>

<style scoped>
.cstmform {
    background-color: transparent !important;
    border-color: white !important;
    color: goldenrod !important;
}
.cstmform::placeholder {
    color: goldenrod !important;
}
.cstmform:focus {
    background: transparent !important;
    color: goldenrod !important;
}
.mh {
    min-height: 570px !important;
}
@media (max-width: 600px) {
    .mh {
        min-height: 667px !important;
    }
}
</style>
