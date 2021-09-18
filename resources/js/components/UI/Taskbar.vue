<template>
    <div>
        <div>
            <b-tabs fill v-if="auth == ''" class="mytab">
                <template #tabs-end>
                    <b-nav-item to="/home" @click="home" class="nav-color"
                        >Home</b-nav-item
                    >
                    <!-- <b-nav-item to="/search" class="nav-color"
                        ><b-icon icon="search"></b-icon>Search</b-nav-item
                    > -->
                    <b-nav-item to="/login" @click="login" class="nav-color"
                        ><b-icon icon="person-fill"></b-icon>Account</b-nav-item
                    >
                </template>
            </b-tabs>
            <b-tabs v-else class="mytab1" justified>
                <template #tabs-end>
                    <b-nav-item to="/play" class="bg-navy" @click="play"
                        ><b-icon icon="diamond" class="text-center"></b-icon>
                        <span class="block">Play</span>
                    </b-nav-item>
                    <b-nav-item to="/wallet" class="bg-navy" @click="wallet"
                        ><b-icon icon="wallet"></b-icon>
                        <span class="block">Wallet</span>
                    </b-nav-item>
                    <b-nav-item to="/chat" class="bg-navy" @click="chat"
                        ><b-icon icon="chat"></b-icon>
                        <span class="block">Chat</span>
                    </b-nav-item>
                    <b-nav-item to="/mine" class="bg-navy" @click="mine">
                        <b-icon icon="person-fill"></b-icon>
                        <span class="block">Mine</span>
                    </b-nav-item>
                </template>
            </b-tabs>

            <!-- <b-tabs fill>
                <template #tabs-end>
                    <b-nav-item to="/play">Play</b-nav-item>
                </template>
            </b-tabs> -->
        </div>
        <!-- <vk-tabs align="justify">
            <vk-tabs-item icon="home" title="home"> <h1>home</h1></vk-tabs-item>
            <vk-tabs-item title="search" icon="search"
                ><h1>search</h1></vk-tabs-item
            >
            <vk-button></vk-button> -->
        <!-- <vk-tabs-item title="account" icon="user" 
                ></vk-tabs-item> -->
        <!-- </vk-tabs> -->
    </div>
</template>

<script>
// import Login from "../pages/Login.vue";
import EventBus from "../EventBus.vue";

export default {
    data() {
        return {
            auth: "",
            user: ""
        };
    },
    // components: {
    //     Login
    // },

    methods: {
        login() {
            this.$router.push("/login");
        },
        logout() {
            localStorage.removeItem("usertoken");
            this.$router.push("/login");
            localStorage.removeItem("path");
            localStorage.setItem("route", "/login");
        },
        play() {
            localStorage.setItem("path", "/play");
            localStorage.removeItem("route");
        },
        wallet() {
            localStorage.setItem("path", "/wallet");
            localStorage.removeItem("route");
        },
        mine() {
            localStorage.setItem("path", "/mine");
            localStorage.removeItem("route");
        },
        chat() {
            localStorage.setItem("path", "/chat");
        },
        home() {
            localStorage.setItem("route", "/home");
            localStorage.removeItem("path");
        },

        login() {
            localStorage.setItem("route", "/login");
            localStorage.removeItem("path");
        }
    },

    mounted() {
        // EventBus.$on("logged-in", status => {
        //     this.auth - status;
        // });
        if (!localStorage.usertoken) {
            this.auth = "";
            this.$attrs.value = "";

            // this.$router.push("/login");
        } else if (localStorage.usertoken) {
            // this.$router.push("/play");
            this.auth = "loggedin";
        }
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
                }
            });
    }
};
</script>

<style>
.bg-dark {
    background: #323440;
    color: #646566;
}
.bg-navy {
    background-color: #011f47ed !important;
}
.nav-link {
    color: #fdcf80;
}
.nav-color a {
    background-color: goldenrod;
}
.nav-color a {
    color: white;
}
.mytab .nav-tabs {
    border-top: 3px solid #323440 !important;
    border-bottom: none;
    position: fixed;
    width: 100%;
    bottom: 0px;
    /* display: flex; */
    margin-bottom: 0px;
}
.mytab1 .nav-tabs {
    border-bottom: none;
    position: fixed;
    width: 100%;
    bottom: 0px;
    /* display: flex; */
    margin-bottom: 0px;
}
.bg-navy > a {
    pointer-events: auto;
}
.bg-navy:hover {
    background-color: white !important;
}
/* .nav-link:hover {
    color: #323440 !important ;
} */
@media (max-width: 600px) {
    .nav-tabs .nav-link {
        border: none !important;
    }
    .block {
        display: block;
    }
}
</style>
