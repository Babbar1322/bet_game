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
                                Exchange Record
                            </span>
                        </b-col>
                        <b-col cols="6"></b-col>
                    </b-row>

                    <table class="table table-responsive bg-dark tble ">
                        <tr>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        <tr v-for="record in records">
                            <td>{{ record.user_id }}</td>
                            <td>{{ record.user_name }}</td>
                            <td>{{ record.user_phone }}</td>
                            <td>{{ record.balance }}</td>
                            <td>
                                {{ new Date(record.created_at).toDateString() }}
                            </td>
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
            records: []
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
                    this.$router.push("/login");
                }
                console.log(res.data);
                this.records = res.data.exchange_record;
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
tr > td > span > .result.Red {
    /* width: 100%; */
    /* height: 10px; */
    background: red;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}
tr > td > span > .result.Green {
    /* width: 100%; */
    /* height: 10px; */
    background: rgb(15, 172, 15);
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}
tr > td > span > .result.Violet {
    /* width: 100%; */
    /* height: 10px; */
    background: purple;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}

.tble > tr > td {
    width: 31%;
}
.tble {
    border: none !important;
    height: 400px;
    overflow: scroll;
}
.tble::-webkit-scrollbar {
    display: none;
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
