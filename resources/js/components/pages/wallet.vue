<template>
    <perfect-scrollbar>
        <b-container>
            <b-row>
                <b-col md="2"></b-col>
                <b-col md="8" class="pl-0 pr-0">
                    <b-card class="bg-royalblue pl-2 pr-2 mh">
                        <b-row align-v="start">
                            <b-col cols="6">
                                <b-img
                                    v-bind="mainProps"
                                    rounded="circle"
                                    :src="`${image}`"
                                ></b-img>
                                <span class="pl-2 " style="color:#12dfe9">{{
                                    balance
                                }}</span>
                            </b-col>
                            <b-col cols="3"></b-col>
                            <b-col cols="3">
                                <div class="text-right">
                                    <Button shape="circle" type="primary"
                                        >Rules</Button
                                    >
                                </div>
                            </b-col>
                        </b-row>

                        <div class="uk-margin-medium-top">
                            <vk-tabs align="justify">
                                <vk-tabs-item title="Recharge">
                                    <b-row>
                                        <!-- <b-col cols="3">
                                            <Button type="success" ghost long
                                                >Ocpay
                                            </Button>
                                        </b-col> -->
                                        <b-col cols="3">
                                            <Button
                                                shape="circle"
                                                type="success"
                                                ghost
                                                long
                                                >UPI
                                            </Button>
                                        </b-col>
                                    </b-row>
                                    <b-row class="mt-4 mb-4">
                                        <b-col class="col-md-3 col-12">
                                            <div class="text-white">
                                                Amount Of Payment
                                            </div>
                                        </b-col>
                                    </b-row>
                                    <div>
                                        <!-- <Icon type="ios-card-outline" /> -->
                                        <Input
                                            v-model="amount"
                                            placeholder="300-50000"
                                            size="large"
                                            className="cstminp"
                                        />
                                    </div>

                                    <b-row class="mt-4 mb-5 pb-5">
                                        <b-col cols="2"></b-col>
                                        <b-col cols="8">
                                            <Button
                                                shape="circle"
                                                type="success"
                                                long
                                                size="large"
                                                @click="payment"
                                                >Recharge
                                            </Button>
                                            <div class="mt-4 mb-2 text-center">
                                                <Button
                                                    shape="circle"
                                                    type="error"
                                                    ghost
                                                    @click="recharge"
                                                    to="/record/recharge"
                                                    >Recharge Record</Button
                                                >
                                            </div>
                                        </b-col>
                                        <b-col cols="2"></b-col>
                                    </b-row>
                                </vk-tabs-item>

                                <vk-tabs-item title="Withdraw"
                                    ><b-row>
                                        <!-- <b-col cols="3">
                                            <Button type="success" ghost long
                                                >Ocpay
                                            </Button>
                                        </b-col> -->
                                        <b-col cols="3"> </b-col>
                                    </b-row>
                                    <b-row class="mt-4 mb-4">
                                        <b-col class="col-md-3 col-12">
                                            <div class="text-white">
                                                Amount Of Withdraw
                                            </div>
                                        </b-col>
                                    </b-row>
                                    <div class="mb-3">
                                        <!-- <Icon type="ios-card-outline" /> -->
                                        <Input
                                            placeholder="200-50000"
                                            size="large"
                                            v-model="wd.amount"
                                        />
                                    </div>
                                    <div class="mt-5 d-inline">
                                        <b-card
                                            class=" height"
                                            style="background: #22232f"
                                        >
                                            <b-row class="pb-2">
                                                <b-col class="col-md-3 col-12">
                                                    <span
                                                        class="pt-5 text-white"
                                                        >Bank Name
                                                    </span>
                                                </b-col>
                                                <b-col class="col-md-9 col-12">
                                                    <input
                                                        type="text"
                                                        class="form-control colored"
                                                        v-model="wd.bank_name"
                                                    />
                                                </b-col>
                                            </b-row>
                                            <b-row class=" pt-2 pb-2">
                                                <b-col class="col-md-3 col-12">
                                                    <span
                                                        class="pt-5 text-white"
                                                        >Phone
                                                    </span>
                                                </b-col>
                                                <b-col class="col-md-9 col-12">
                                                    <input
                                                        type="text"
                                                        class="form-control colored"
                                                        v-model="wd.phone"
                                                    />
                                                </b-col>
                                            </b-row>
                                            <b-row class=" pt-2 pb-2">
                                                <b-col class="col-md-3 col-12">
                                                    <span
                                                        class="pt-5 text-white"
                                                        >Email
                                                    </span>
                                                </b-col>
                                                <b-col class="col-md-9 col-12">
                                                    <input
                                                        type="text"
                                                        class="form-control colored"
                                                        v-model="wd.email"
                                                    />
                                                </b-col>
                                            </b-row>
                                            <!-- <b-row class=" pt-2 pb-2">
                                                <b-col class="col-md-10 col-7">
                                                    <span
                                                        class="pt-5 text-white"
                                                        >Choose Card
                                                    </span>
                                                </b-col>
                                                <b-col class="col-md-2 col-5">
                                                    <Upload>
                                                        <Button type="primary"
                                                            >Choose</Button
                                                        >
                                                    </Upload>
                                                </b-col>
                                            </b-row> -->
                                            <b-row class=" pt-2">
                                                <b-col class="col-md-3 col-12">
                                                    <span
                                                        class="pt-5 text-white"
                                                        >Actual Name
                                                    </span>
                                                </b-col>
                                                <b-col class="col-md-9 col-12">
                                                    <input
                                                        type="text"
                                                        class="form-control colored"
                                                        placeholder="Please Enter"
                                                        v-model="wd.user_name"
                                                    />
                                                </b-col>
                                            </b-row>
                                        </b-card>
                                    </div>
                                    <b-row class="mt-4 mb-5 pb-5">
                                        <b-col cols="2"></b-col>
                                        <b-col cols="8">
                                            <Button
                                                shape="circle"
                                                type="success"
                                                long
                                                size="large"
                                                @click="paywith"
                                                >Withdraw
                                            </Button>
                                            <div class="mt-4 mb-2 text-center">
                                                <Button
                                                    shape="circle"
                                                    type="error"
                                                    ghost
                                                    to="/record/withdraw"
                                                    >Withdraw Record</Button
                                                >
                                            </div>
                                        </b-col>
                                        <b-col cols="2"></b-col> </b-row
                                ></vk-tabs-item>
                            </vk-tabs>
                        </div>
                    </b-card>
                </b-col>
                <b-col md="2"></b-col>
            </b-row>
        </b-container>
    </perfect-scrollbar>
</template>

<script>
export default {
    data() {
        return {
            image: "profile.jpg",
            balance: "",
            mainProps: { width: 35 },
            amount: "",
            wd: {
                bank_name: "",
                phone: "",
                email: "",
                user_name: "",
                user_id: "",
                user_uid: "",
                amount: ""
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
                console.log(res.data);

                if (res.data[0] == "token_expired") {
                    this.auth = "";
                    this.$router.push("/login");
                    localStorage.setItem("route", "/login");
                    localStorage.removeItem("path");
                }
                this.balance = res.data.balance.toFixed(2);
                if (res.data.user.image == "" || res.data.user.image == null) {
                    this.image = "profile.jpg";
                } else {
                    this.image = "/uploads/" + res.data.user.image;
                }
                this.wd.user_id = res.data.user.id;
                this.wd.user_uid = res.data.user.UID;
                this.wd.user_name = res.data.user.name;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        payment() {
            if (this.amount < 300) {
                this.amount = "";
                this.i("amount should be greater than or equal to 300");
            } else {
                this.$router.push({
                    name: "payment",
                    params: { amount: this.amount }
                });
            }
        },
        paywith() {
            if (this.wd.amount < this.balance) {
                axios
                    .post("/api/withdraw", {
                        user_id: this.wd.user_id,
                        user_uid: this.wd.user_uid,
                        user_name: this.wd.user_name,
                        bank_name: this.wd.bank_name,
                        amount: this.wd.amount,
                        email: this.wd.email,
                        phone: this.wd.phone
                    })
                    .then(res => {
                        this.balance = this.balance - res.data.wallet.balance;
                        this.s(res.data.res);
                    })
                    .catch(err => {
                        this.i(err.response.data.message);
                    });
            } else {
                this.i("not enough balance to withdraw");
            }
        },
        recharge() {
            localStorage.setItem("path", "/record/recharge");
        },
        withdraw() {
            localStorage.setItem("path", "/record/withdraw");
        }
    }
};
</script>

<style>
.text-yellow {
    color: #fdcf80;
}
.bg-dark-yellow {
    background-color: rgb(238, 164, 58) !important;
}
.bg-royalblue {
    background-color: #353849 !important;
}

body::-webkit-scrollbar {
    display: none;
}
.tab-content {
    color: white;
}
.tab-content > .tab-pane {
    display: inline-block !important;
}
.uk-tab {
    color: white;
}
.uk-tab::before {
    border-bottom: none !important;
}
.uk-tab > * > a {
    border: none;
}
.uk-tab > .uk-active > a {
    border-color: transparent !important;
}
.uk-active > a {
    color: rgb(238, 164, 58) !important;
    font-weight: 600;
}
/* input {
    text-align: right;
} */
.ivu-input-large {
    color: white !important;
    background-color: #22232f !important;
    border-color: #22232f !important;
    text-align: right;
}
.ivu-icon {
    /* position: absolute; */
    color: white;
    /* left: 30px;
    bottom: 25px; */
}
.colored {
    background-color: transparent !important;
    color: white !important;
    border: 1px solid #80808054 !important;
}
.form-control:focus {
    box-shadow: none !important;
}
.height {
    min-height: auto !important;
}
.mh {
    min-height: 530px !important;
}
@media (max-width: 600px) {
    .mh {
        min-height: 610px !important;
    }
}
</style>
