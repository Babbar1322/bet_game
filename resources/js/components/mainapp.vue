<template>
    <div>
        <router-view />
        <footer v-if="this.$route.name != 'payment'">
            <taskbar :key="$route.fullPath" />
        </footer>
    </div>
</template>

<script>
import taskbar from "./UI/Taskbar.vue";
export default {
    components: {
        taskbar
    },
    // data() {
    //     return {
    //         auth: "",
    //         user: ""
    //     };
    // },

    methods: {
        login() {
            this.$router.push("/login");
        }
    },
    mounted() {
        if (localStorage.usertoken && localStorage.path) {
            // this.$router.push("/play");
            var path = localStorage.path;
            this.$router.push(path);
        } else if (localStorage.route) {
            if (this.$route.name == "invite") {
                this.$router.push({ name: "invite" });
            } else {
                var path = localStorage.route;
                this.$router.push(path);
            }
        } else {
            if (this.$route.name == "invite") {
                this.$router.push({ name: "invite" });
            } else {
                this.$router.push("/login");
            }
        }

        localStorage.removeItem("time");
    }
};
</script>

<style>
/* .ivu-tabs-nav-scroll,
.ivu-tabs-nav {
    text-align-last: center !important;
    float: inherit !important;
}
.ivu-tabs-ink-bar {
    display: none;
}
.ivu-tabs-bar {
    position: fixed;
    bottom: 0px;
    width: 100%;
    border-bottom: none;
} */
/* .uk-tab {
    position: absolute;
    width: 100%;
    bottom: 0px;
    margin-bottom: 0px;
}
.uk-tab > .uk-active > a {
    color: lightcoral;
    /* border-color: #1e87f0; */
/* border: none;
}  */
.nav-tabs {
    border-top: 2px solid #fdcf80;
    border-bottom: none;
    position: fixed;
    width: 100%;
    bottom: 0px;
    display: flex;
    margin-bottom: 0px;
}
/* :focus-visible {
    outline: none;
} */
.nav-tabs .nav-link:hover,
.nav-tabs .nav-link:focus {
    border: none;
}
.nav-tabs .nav-link:hover,
.nav-tabs .nav-link:focus {
    border: none;
}
a {
    color: black;
}
.router-link-exact-active,
.router-link-active {
    color: 323440 !important;
}
/* body {
    overflow: hidden;
} */
body {
    overflow-x: hidden;
}
</style>
