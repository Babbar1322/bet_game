<template>
    <b-container>
        <b-row>
            <b-col cols="2"></b-col>
            <b-col class="col-md-8 col-12 pl-0 pr-0">
                <b-card class="bg-royalblue mh">
                    <b-row>
                        <b-col cols="6" class="text-white">
                            <router-link to="/mine/invite">
                                <b-icon
                                    icon="chevron-left"
                                    class="h3 text-white"
                                    @click="back"
                            /></router-link>
                            <span style="position:relative;bottom:10px;">
                                Invite Rules
                            </span>
                        </b-col>
                        <b-col cols="6"></b-col>
                    </b-row>

                    <table class="table table-responsive-lg bg-dark tble ">
                        <tr>
                            <th>Level</th>
                            <th>Percentage</th>
                        </tr>
                        <tr v-for="rule in rules">
                            <td>{{ rule.level }}</td>
                            <td>{{ rule.percentage }} %</td>
                        </tr>
                    </table>
                </b-card>
            </b-col>
            <b-col cols="2"></b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    data() {
        return {
            // records: [],
            rules: []
        };
    },
    created() {
        // axios
        //     .get("../api/results")
        //     .then(res => {
        //         console.log(res);
        //         this.records = res.data;
        //         console.log(res.data);
        //     })
        //     .catch(err => {
        //         console.log(err);
        //     });
        axios
            .get("/api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                if (res.data[0] == "token_expired") {
                    this.$router.push("/login");
                }
                console.log(res.data);
                this.rules = res.data.invite_rule;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        back() {
            localStorage.setItem("path", "/mine/invite");
        }
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
