<template>
    <b-container>
        <b-row>
            <b-col md="2"></b-col>
            <b-col md="8" class="pl-0 pr-0">
                <b-card class="bg-royalblue pl-2 pr-2 mh">
                    <b-row>
                        <b-col cols="12" class="text-white">
                            <router-link to="/mine">
                                <Icon type="ios-arrow-back"
                            /></router-link>
                            My Info
                        </b-col>
                        <b-col cols="6"></b-col>
                    </b-row>
                    <div class="mt-4">
                        <div role="button" class="text-white">
                            <b-row class="pb-2" @click="avatar">
                                <b-col cols="6">
                                    <div>
                                        Avatar
                                    </div>
                                </b-col>
                                <!-- <b-col cols="6"></b-col> -->
                                <b-col cols="6">
                                    <div class="text-right">
                                        <b-img
                                            v-bind="mainProps"
                                            rounded="circle"
                                            :src="`/uploads/${image}`"
                                        ></b-img>
                                        <Icon
                                            type="ios-arrow-forward"
                                            size="20"
                                        />
                                    </div>
                                </b-col>
                            </b-row>
                            <b-row
                                class="pt-2 pb-2 border-bottom border-top border-dark"
                                @click="resetname"
                            >
                                <b-col cols="6">
                                    <div>
                                        NickName
                                    </div>
                                </b-col>
                                <!-- <b-col cols="6"></b-col> -->
                                <b-col cols="6">
                                    <div class="text-right">
                                        {{ name }}
                                        <Icon
                                            type="ios-arrow-forward"
                                            size="20"
                                        />
                                    </div>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    data() {
        return {
            mainProps: { width: 30 },
            users: [],
            name: "",
            image: "../profile.jpg"
        };
    },
    methods: {
        resetname() {
            this.$router.push("/mine/user/info/nickname");
            localStorage.setItem("path", "/mine/user/info/nickname");
        },
        avatar() {
            this.$router.push("/mine/user/info/avatar");
        }
    },
    created() {
        axios
            .get("../../api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                if (res.data[0] == "token_expired") {
                    this.auth = "";
                    this.$router.push("/login");
                    localStorage.removeItem("path");
                    localStorage.setItem("route", "/login");
                }
                if (res.data.user.image == "" || res.data.user.image == null) {
                    this.image = "../profile.jpg";
                } else {
                    this.image = "../uploads/" + res.data.user.image;
                }
                console.log(res);
                if (res.data.user.name == "" || res.data.user.name == null) {
                    this.name = res.data.user.phone;
                } else {
                    this.name = res.data.user.name;
                }
            })
            .catch(err => {
                console.log(err);
            });
    }
};
</script>

<style>
.mh {
    min-height: 530px !important;
}
@media (max-width: 600px) {
    .mh {
        min-height: 610px !important;
    }
}
</style>
