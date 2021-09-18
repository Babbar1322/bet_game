<template>
    <b-container>
        <b-row>
            <b-col cols="2"></b-col>
            <b-col class="col-md-8 col-12 pl-0 pr-0">
                <b-card class="bg-royalblue mh">
                    <b-row>
                        <b-col cols="6" class="text-white">
                            <router-link to="/mine">
                                <Icon type="ios-arrow-back" @click="back"
                            /></router-link>
                            Invite Friends
                        </b-col>
                        <b-col cols="6"></b-col>
                    </b-row>
                    <div class="mt-3 text-center">
                        <h4 class="text-white mb-3">
                            Bonus :
                            <span class="text-gold">{{ total_bonus }}</span>
                        </h4>
                        <Button
                            shape="circle"
                            type="info"
                            class="mb-1"
                            @click="confirm"
                        >
                            Exchange to Balance</Button
                        >
                        <Button
                            shape="circle"
                            ghost
                            class="mb-1"
                            @click="exRecord"
                        >
                            Exchange Record</Button
                        >
                    </div>
                    <div class="mt-4">
                        <vk-tabs align="justify">
                            <vk-tabs-item title="Level 1">
                                <b-row class="mt-2">
                                    <!-- <b-col cols="1"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Total People</p>
                                        <p class="text-warning ">
                                            {{ people }}
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="2"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Contribution</p>
                                        <p class="text-warning ">
                                            {{ contribute }}
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="1"></b-col> -->
                                </b-row>
                                <!-- <div class="mt-5">
                                    <b-row>
                                        <b-col cols="4">
                                            <Button
                                                shape="circle"
                                                type="warning"
                                                long
                                                @click="invite"
                                                >Invite Record</Button
                                            >
                                        </b-col>
                                        <b-col cols="4">
                                            <Button
                                                @click="bonus"
                                                shape="circle"
                                                type="success"
                                                long
                                                >Bonus Record</Button
                                            >
                                        </b-col>
                                        <b-col cols="4">
                                            <Button
                                                shape="circle"
                                                type="error"
                                                long
                                                >Invite Rules</Button
                                            >
                                        </b-col>
                                    </b-row>
                                </div>
                                <div class="mt-3">
                                    <p class="text-white">
                                        Your Invitation Link
                                    </p>
                                </div>
                                <div class="mt-2 d-inline">
                                    <Input v-model="data.link" disabled>
                                        <Button
                                            shape="circle"
                                            type="primary"
                                            slot="append"
                                            v-clipboard="value"
                                            >Copy link</Button
                                        >
                                    </Input>
                                </div>
                                <div class="mt-2">
                                    <p class="text-white">
                                        Your invitation QR code
                                    </p>
                                </div> -->
                            </vk-tabs-item>
                            <vk-tabs-item title="Level 2">
                                <b-row class="mt-2">
                                    <!-- <b-col cols="1"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Total People</p>
                                        <p class="text-warning ">
                                            6
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="4"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Contribution</p>
                                        <p class="text-warning ">
                                            120.72
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="1"></b-col> -->
                                </b-row>
                                <!-- <div class="mt-5">
                                    <b-row>
                                        <b-col cols="4">
                                            <Button
                                                shape="circle"
                                                type="warning"
                                                long
                                                >Invite Record</Button
                                            >
                                        </b-col>
                                        <b-col cols="4">
                                            <Button
                                                shape="circle"
                                                type="success"
                                                long
                                                >Bonus Record</Button
                                            >
                                        </b-col>
                                        <b-col cols="4">
                                            <Button
                                                shape="circle"
                                                type="error"
                                                long
                                                >Invite Rules</Button
                                            >
                                        </b-col>
                                    </b-row>
                                </div>
                                <div class="mt-3">
                                    <p class="text-white">
                                        Your Invitation Link
                                    </p>
                                </div>
                                <div class="mt-2 d-inline">
                                    <Input v-model="data.link" disabled>
                                        <Button
                                            shape="circle"
                                            type="primary"
                                            slot="append"
                                            >Copy link</Button
                                        >
                                    </Input>
                                </div>
                                <div class="mt-2">
                                    <p class="text-white">
                                        Your invitation QR code
                                    </p>
                                </div> -->
                            </vk-tabs-item>
                            <vk-tabs-item title="Level 3">
                                <b-row class="mt-2">
                                    <!-- <b-col cols="1"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Total People</p>
                                        <p class="text-warning ">
                                            6
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="4"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Contribution</p>
                                        <p class="text-warning ">
                                            120.72
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="1"></b-col> -->
                                </b-row>
                            </vk-tabs-item>
                            <vk-tabs-item title="Level 4">
                                <b-row class="mt-2">
                                    <!-- <b-col cols="1"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Total People</p>
                                        <p class="text-warning ">
                                            6
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="4"></b-col> -->
                                    <b-col cols="6" class="text-center">
                                        <p class="text-white">Contribution</p>
                                        <p class="text-warning ">
                                            120.72
                                        </p>
                                    </b-col>
                                    <!-- <b-col cols="1"></b-col> -->
                                </b-row>
                            </vk-tabs-item>
                        </vk-tabs>
                        <div class="mt-5">
                            <b-row>
                                <b-col cols="4">
                                    <Button
                                        shape="circle"
                                        type="warning"
                                        long
                                        @click="invite"
                                        >Invite Record</Button
                                    >
                                </b-col>
                                <b-col cols="4">
                                    <Button
                                        @click="bonus"
                                        shape="circle"
                                        type="success"
                                        long
                                        >Bonus Record</Button
                                    >
                                </b-col>
                                <b-col cols="4">
                                    <Button
                                        shape="circle"
                                        type="error"
                                        long
                                        @click="rules"
                                        >Invite Rules</Button
                                    >
                                </b-col>
                            </b-row>
                        </div>
                        <div class="mt-3">
                            <p class="text-white">
                                Your Invitation Link
                            </p>
                        </div>
                        <div class="mt-2 d-inline">
                            <Input v-model="data.link" disabled>
                                <Button
                                    shape="circle"
                                    type="primary"
                                    slot="append"
                                    v-clipboard="value"
                                    >Copy link</Button
                                >
                            </Input>
                        </div>
                        <div class="mt-2">
                            <p class="text-white">
                                Your invitation QR code
                            </p>
                        </div>
                        <Modal v-model="modal1">
                            <div class="text-center">
                                Are You Sure to Exchange Balance
                            </div>

                            <div slot="footer">
                                <Button
                                    shape="circle"
                                    @click="cancel"
                                    :loading="loading"
                                    >Cancel</Button
                                >
                                <Button
                                    shape="circle"
                                    @click="exchange"
                                    :loading="loading"
                                    >Confirm</Button
                                >
                            </div>
                        </Modal>
                    </div>
                </b-card>
            </b-col></b-row
        >
    </b-container>
</template>

<script>
export default {
    data() {
        return {
            contribute: "",
            modal1: false,
            loading: false,
            uid: "",
            user_id: "",
            people: "",
            total_bonus: 0,
            data: {
                link: ""
            }
        };
    },
    created() {
        axios
            .get("../api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                if (res.data[0] == "token_expired") {
                    this.auth = "";
                    this.$router.push("/login");
                }
                this.total_bonus = res.data.total_bonus;
                this.uid = res.data.user.UID;
                this.user_id = res.data.user.id;
                this.people = res.data.totalperson;
                this.contribute = res.data.contribute;
                this.data.link =
                    "http://localhost:8000/invite/" + res.data.user.UID;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        value() {
            this.i("link copied");
            return this.data.link;
        },
        bonus() {
            this.$router.push("/mine/invite/bonusRecord");
            localStorage.setItem("path", "/mine/invite/bonusRecord");
        },
        invite() {
            this.$router.push({ name: "inviteRecord" });
            localStorage.setItem("path", "/mine/invite/inviteRecord");
        },
        exRecord() {
            this.$router.push({ name: "exchangeRecord" });
            localStorage.setItem("path", "/mine/invite/exchangeRecord");
        },
        confirm() {
            this.modal1 = true;
        },
        cancel() {
            this.modal1 = false;
        },
        exchange() {
            this.loading = true;
            if (this.total_bonus > 0) {
                axios
                    .post("/api/exchange", {
                        amount: this.total_bonus,
                        user_id: this.user_id
                    })
                    .then(res => {
                        console.log(res);
                        this.loading = false;
                        this.modal1 = false;
                    })
                    .catch(err => {
                        console.log(err);
                        this.loading = false;
                        this.modal1 = false;
                    });
            } else {
                this.i("not enough balance to exchange");
                this.modal1 = false;
            }
        },
        back() {
            localStorage.setItem("path", "/mine");
        },
        rules() {
            this.$router.push("/mine/invite/rules");
            localStorage.setItem("path", "/mine/invite/rules");
        }
    }
};
</script>

<style>
.mh {
    min-height: 530px !important;
}
.ivu-input[disabled] {
    color: white !important;
    background-color: #22232f !important;
    border-color: #22232f !important;
}
.ivu-btn-primary {
    background-color: #2d8cf0 !important;
    border: 1px solid #2d8cf0 !important;
    color: white !important;
}
.ivu-btn-long {
    width: 100% !important;
    text-align: center !important;
    height: auto !important;
    padding: 5px !important;
    white-space: inherit !important;
}
.ivu-input-group-append {
    background-color: #22232f !important ;
    border: none !important;
}
@media (max-width: 600px) {
    .mh {
        min-height: 610px !important;
    }
}
</style>
