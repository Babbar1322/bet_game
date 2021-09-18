<template>
    <perfect-scrollbar>
        <b-container>
            <b-row>
                <b-col md="2"></b-col>
                <b-col md="8" class="pl-0 pr-0">
                    <b-card class="bg-royalblue ">
                        <b-row align-v="start" class="bordered">
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
                            <!-- <b-col cols="3"></b-col> -->
                            <b-col cols="6">
                                <div class="text-right">
                                    <div class="text-yellow">
                                        Statistics today
                                    </div>
                                    <div
                                        style="color:#12dfe9"
                                        class="text-right"
                                    >
                                        {{ statics }}
                                    </div>
                                </div>
                            </b-col>
                        </b-row>
                        <!-- <b-card class="mt-5 bg-dark-yellow">
                        <b-row align-v="start" class="text-yellow">
                            <b-col cols="6">
                                <p>Account Card</p>
                            </b-col>
                            <b-col cols="3"></b-col>
                            <b-col cols="3"></b-col>
                        </b-row>
                        </b-card> -->
                        <div class="text-center text-white mt-3">
                            <b>Parity</b>
                        </div>
                        <b-row class="mt-2">
                            <b-col cols="6">
                                <div>
                                    <div class="text-yellow">Next period</div>
                                    <div class="text-white">{{ game_id }}</div>
                                </div>
                            </b-col>
                            <b-col cols="2"></b-col>
                            <b-col cols="4">
                                <div class="text-right">
                                    <div class="text-yellow">Count Down</div>
                                    <div class="text-white">
                                        <vue-countdown-timer
                                            :start-time="startTimer"
                                            :end-time="endTimer"
                                            :interval="1000"
                                            label-position="begin"
                                            :end-text="null"
                                            :day-txt="null"
                                            :hour-txt="':'"
                                            :minutes-txt="':'"
                                            :seconds-txt="null"
                                        >
                                        </vue-countdown-timer>
                                    </div>
                                </div>
                            </b-col>
                        </b-row>
                        <b-row class="mt-4 text-center w-btn">
                            <!-- <b-col md="4" sm="4" class="mb-2">
                                <Button
                                    shape="circle"
                                    type="success"
                                    size="large"
                                    long
                                    @click="joinModal('Join Green', 'Green')"
                                    >Join Green</Button
                                >
                            </b-col>
                            <b-col md="4" sm="4" class="mb-2">
                                <Button
                                    shape="circle"
                                    type="warning"
                                    size="large"
                                    long
                                    @click="joinModal('Join Violet', 'Violet')"
                                    >Join Violet</Button
                                >
                            </b-col>
                            <b-col md="4" sm="4">
                                <Button
                                    shape="circle"
                                    type="error"
                                    size="large"
                                    long
                                    @click="joinModal('Join Red', 'Red')"
                                    >Join Red</Button
                                >
                            </b-col> -->
                            <b-col cols="4" class="mb-2">
                                <Button
                                    shape="circle"
                                    type="success"
                                    long
                                    @click="joinModal('Join Green', 'Green')"
                                    >Join Green</Button
                                >
                            </b-col>
                            <b-col cols="4">
                                <Button
                                    shape="circle"
                                    type="warning"
                                    long
                                    @click="joinModal('Join Violet', 'Violet')"
                                    >Join Violet</Button
                                >
                            </b-col>
                            <b-col cols="4">
                                <Button
                                    shape="circle"
                                    type="error"
                                    long
                                    @click="joinModal('Join Red', 'Red')"
                                    >Join Red</Button
                                >
                            </b-col>
                        </b-row>
                        <b-row class="mt-3 bitbtn">
                            <b-col cols="1"></b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="warning"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 0', '0')"
                                    >0</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="success"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 1', '1')"
                                    >1</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="error"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 2', '2')"
                                    >2</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="success"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 3', '3')"
                                    >3</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="error"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 4', '4')"
                                    >4</Button
                                >
                            </b-col>
                            <b-col cols="1"></b-col>
                        </b-row>
                        <b-row class="mt-3 bitbtn">
                            <b-col cols="1"></b-col>

                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="warning"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 5', '5')"
                                    >5</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="error"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 6', '6')"
                                    >6</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="success"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 7', '7')"
                                    >7</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="error"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 8', '8')"
                                    >8</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    class="cstmbtn"
                                    shape="circle"
                                    type="success"
                                    ghost
                                    size="large"
                                    long
                                    @click="joinModal('Select 9', '9')"
                                    >9</Button
                                >
                            </b-col>
                            <b-col cols="1"></b-col>
                        </b-row>
                        <b-row class="mt-4">
                            <b-col cols="4"> </b-col>
                            <b-col cols="2" class="r-btn">
                                <Button
                                    shape="circle"
                                    size="small"
                                    ghost
                                    to="/record/game"
                                    @click="next"
                                    >Game Record</Button
                                >
                            </b-col>
                            <b-col cols="2">
                                <Button
                                    shape="circle"
                                    size="small"
                                    ghost
                                    @click="openModal"
                                    >Game Rule</Button
                                >
                            </b-col>
                            <b-col cols="4"> </b-col>
                        </b-row>
                        <div class="mt-2 cstmtble">
                            <!-- <table class="table table-responsive table-dark">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        <th>Price</th>
                                        <th>Number</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2021876543</td>
                                        <td>87483</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2021876543</td>
                                        <td>87483</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2021876543</td>
                                        <td>87483</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2021876543</td>
                                        <td>87483</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2021876543</td>
                                        <td>87483</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2021876543</td>
                                        <td>87483</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table> -->

                            <!-- <Table
                                height="200"
                                :columns="columns1"
                                :data="data2"
                            ></Table> -->

                            <!-- <div class="tabledata">
                                <b-table
                                    striped
                                    hover
                                    :items="results"
                                    :fields="columns1"
                                ></b-table>
                            </div> -->
                            <table class="table table-striped  ">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        <!-- <th>Price</th> -->
                                        <th>Number</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody v-if="results">
                                    <tr class="lh" v-for="result in results">
                                        <td>{{ result.game_id }}</td>
                                        <!-- <td>{{ result.price }}</td> -->
                                        <td
                                            class="number"
                                            :class="result.result"
                                        >
                                            {{ result.number }}
                                        </td>
                                        <td>
                                            <span
                                                v-for="colors in result.result"
                                                class="d-inline-flex"
                                            >
                                                <span
                                                    :class="colors"
                                                    class="result"
                                                ></span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </b-card>
                </b-col>
                <b-col md="2"></b-col>
            </b-row>
            <Spin size="large" fix v-if="spinShow"></Spin>

            <!-- <vue-loaders-ball-scale-multiple /> -->
        </b-container>
    </perfect-scrollbar>
</template>

<script>
import rule from "./rule.vue";
import joinmodal from "./joinModal.vue";
export default {
    data() {
        return {
            fullPage: true,
            isLoading: false,
            statics: "",
            colors: [],
            results: [],
            game_id: null,
            data: [],
            minutes: 0,
            seconds: 0,
            distance: 0,
            spinShow: false,
            startTimer: null,
            endTimer: null,
            image: "profile.jpg",
            balance: "",
            mainProps: { width: 35 },
            columns1: [
                {
                    title: "Period",
                    key: "game_id"
                },
                {
                    title: "Price",
                    key: "price"
                },
                {
                    title: "Number",
                    key: "number",
                    class: "green"
                },
                {
                    title: "Result",
                    key: "result",
                    class: "red"
                }
            ],
            data2: [
                {
                    period: "2021876543",
                    price: 87483,
                    number: 1,
                    date: "2016-10-03"
                },
                {
                    period: "2021876543",
                    price: 87483,
                    number: 2,
                    date: "2016-10-01"
                },
                {
                    period: "2021876543",
                    price: 87483,
                    number: 3,
                    date: "2016-10-02"
                },
                {
                    period: "2021876543",
                    price: 87483,
                    number: 1,
                    date: "2016-10-04"
                },
                {
                    period: "2021876543",
                    price: 87483,
                    number: 1,
                    date: "2016-10-03"
                },
                {
                    period: "2021876543",
                    price: 87483,
                    number: 1,
                    date: "2016-10-01"
                },
                {
                    period: "2021876543",
                    price: 87483,
                    number: 1,
                    date: "2016-10-02"
                },
                {
                    period: "2021876543",
                    price: 87483,
                    number: 1,
                    date: "2016-10-04"
                }
            ]
        };
    },
    methods: {
        openModal() {
            this.$FModal.show({
                component: rule
            });
        },
        joinModal(val, val1) {
            this.$FModal.show(
                {
                    component: joinmodal
                },
                {
                    msg: val,
                    colnums: val1,
                    gameId: this.game_id,
                    update: this.update
                }
                // { update: this.update }
            );
        },
        update(data) {
            this.balance = data;
        },
        next() {
            localStorage.setItem("path", "/record/game");
        }
    },
    created() {
        //get game result
        this.isLoading = true;
        axios
            .get("/api/results")
            .then(res => {
                this.isLoading = false;
                console.log(res);
                this.results = res.data;
                console.log(res.data);
                var j = 3;
                for (var i = 0; i <= res.data.length; i++) {
                    this.colors[i] = res.data[i].result;
                    // this.columns1[j].class = res.data[i].result;
                    // j++;
                    // j = j + 2;
                }
            })
            .catch(err => {
                console.log(err);
            });
        //calculate a random number with today date for generate game id
        var month = new Date().getMonth();
        var date = new Date().getDate();
        if (date < 9) {
            var date = "0" + date;
        }
        if (month < 9) {
            var month = "0" + month;
        }
        var game_id = new Date().getFullYear() + month + date + "001";
        axios.get("/api/gameId").then(res => {
            this.isLoading = false;
            if (res.data.game_id) {
                this.game_id = res.data.game_id;
            } else {
                this.game_id = game_id;
            }
        });
        this.game_id = game_id;
        axios.get("/api/timer").then(res => {
            this.isLoading = false;
            this.startTimer = parseInt(res.data.timer.start_time);
            this.endTimer = parseInt(res.data.timer.end_time);
            localStorage.setItem("time", res.data.timer.end_time);
        });
        axios
            .get("/api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                this.isLoading = false;
                if (res.data[0] == "token_expired") {
                    this.$router.push("/login");
                }
                this.balance = res.data.balance.toFixed(2);
                this.statics = res.data.statics;
                // console.log(res);
                if (res.data.user.image == "" || res.data.user.image == null) {
                    this.image = "profile.jpg";
                } else {
                    this.image = "/uploads/" + res.data.user.image;
                }
            })
            .catch(err => {
                console.log(err);
            });
    },
    mounted() {
        var vm = this;
        setInterval(function() {
            var now = new Date().getTime();
            vm.distance = localStorage.time - now;
            var m = Math.floor(vm.distance % (1000 * 60 * 60)) / (1000 * 60);
            vm.minutes = parseFloat(m).toFixed(0);
            vm.seconds = Math.floor((vm.distance % (1000 * 60)) / 1000);
            if (vm.minutes == 0 && vm.seconds == 30) {
                vm.spinShow = true;
            } else if (vm.minutes <= 0 && vm.seconds <= 0) {
                vm.spinShow = false;

                // window.location.reload();
                // axios
                //     .get("/api/result")
                //     .then(res => {
                //         for (var i = 0; i < res.data.game.length; i++) {
                //             vm.data2[i].price = res.data.game[i].amount;
                //         }
                //     })
                //     .catch(err => {
                //         console.log(err);
                //     });
            } else if (vm.seconds > 29) {
                vm.minutes -= 1;
                vm.minutes = vm.minutes.toString();
            } else if (vm.seconds < 10) {
                vm.seconds = "0" + vm.seconds;
            }

            if (vm.distance < 0) {
                if (vm.distance < -1000 * 60 * 24 * 1) {
                    vm.countDownDate += 1000 * 60 * 60 * 24 * 1 * 365;
                }
            }
        }, 1000);
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
.ivu-icon {
    font-size: 30px;
}
/* .ps {
    height: 550px;
} */
.bordered {
    border: 1px solid;
    border-radius: 25px;
}
.ivu-btn-warning {
    background-color: rgb(114, 50, 221) !important;
    border-color: rgb(114, 50, 221) !important;
}
.ivu-btn-ghost.ivu-btn-warning {
    color: rgb(114, 50, 221) !important;
    background: transparent !important;
}
.ivu-table .ivu-table-row td {
    background-color: transparent !important;
    color: #fff;
}
.ivu-table th {
    background-color: #011f47ed !important;
    color: #fff;
}
.ivu-table td,
.ivu-table th {
    border-bottom: none !important;
}
.ivu-table {
    background-color: transparent !important;
}
.ivu-table:before {
    background-color: transparent !important;
}
.ivu-table-overflowY::-webkit-scrollbar {
    display: none;
}
body::-webkit-scrollbar {
    display: none;
}
td .green {
    color: lightgreen !important;
}
/* tbody > tr > .red > div > span { */
tbody > tr > .red,
tbody > tr > td > span > .result.Red {
    /* width: 100%; */
    /* height: 10px; */
    background: red;
    display: inline-block;
    border-radius: 100px;
    margin-top: 6px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}
tbody > tr > td > span > .result.Green {
    /* width: 100%; */
    /* height: 10px; */
    background: rgb(15, 172, 15);
    display: inline-block;
    border-radius: 100px;
    margin-top: 6px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}
tbody > tr > td > span > .result.Violet {
    /* width: 100%; */
    /* height: 10px; */
    background: purple;
    display: inline-block;
    border-radius: 100px;
    margin-top: 6px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}

tbody > tr > .number.Red {
    color: red;
}
tbody > tr > .number.Green {
    color: green;
}
tbody > tr > .number.Violet {
    color: purple;
}
/* tbody > tr > .red > div { */
tbody > tr > .red > {
    text-align: center;
}
.table th,
.table td {
    padding: 6px !important;
    vertical-align: top;
    border-top: none !important;
    color: white;
    text-align: center;
}
thead {
    background: #011f47ed;
    text-align: center;
}
.table thead th {
    border: none !important;
}
.cstmtble {
    height: 40vh;
    overflow: scroll;
}
.cstmtble::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE and Edge */
.cstmtble {
    -ms-overflow-style: none;
}
/* table {
    height: 200px;
    overflow: scroll;
} */
/* thead > tr > .green {
    color: white !important;
} */
tbody > tr > .green {
    color: lightgreen !important;
    text-align: center;
}
.lh {
    line-height: 30px;
}
/* @media (max-width: 420px) {
    .w-btn > div > button {
        width: 100px;
        padding-top: 0px;
    }
} */
/* .cstmbtn {
    padding-left: 20px !important;
    padding-right: 20px !important;
} */
@media (min-width: 170px) {
    .r-btn > a {
        position: absolute;
        right: 0px;
    }
    /* div > .cstmbtn {
        padding-left: 17px !important;
        padding-right: 20px !important;
    } */
}
@media (max-width: 400px) {
    .bitbtn .ivu-btn-long {
        width: auto !important;
    }
    div > .cstmbtn {
        /* padding-left: 17px !important;
        padding-right: 20px !important; */
        padding: 5px 20px !important;
    }
    .bitbtn > .col-1 {
        margin-left: -10px !important;
    }
}
</style>
