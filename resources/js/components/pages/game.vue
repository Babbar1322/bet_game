<template>
    <b-container>
        <b-row>
            <b-col cols="2"></b-col>
            <b-col class="col-md-8 col-12 pl-0 pr-0">
                <b-card class="bg-royalblue">
                    <b-row>
                        <b-col cols="6" class="text-white">
                            <router-link to="/play">
                                <b-icon
                                    icon="chevron-left"
                                    class="h3 text-white"
                                    @click="back"
                            /></router-link>
                            <span style="position:relative;bottom:10px;">
                                Game Record
                            </span>
                        </b-col>
                        <b-col cols="6"></b-col>
                    </b-row>

                    <!-- <vk-tabs align="justify" class="mt-5">
                        <vk-tabs-item title="All"> -->
                    <table class="table  bg-dark tble ">
                        <tr v-for="record in user_data">
                            <td class="text-yellow">
                                {{ record.period }}
                            </td>
                            <!-- <td class="text-white">
                                {{ record.id }}
                            </td>
                            <td class="text-white">
                                {{ record.betType }}
                            </td>
                            <td v-if="record.betType == 'number'">
                                {{ record.colnum }}
                            </td>
                            <td v-else>
                                <span class="d-inline-flex">
                                    <span
                                        :class="record.colnum"
                                        class="result"
                                    ></span>
                                </span>
                            </td> -->
                            <td>
                                {{
                                    record.game_status == 1
                                        ? "Finished"
                                        : "Pending"
                                }}
                            </td>
                            <td
                                :class="
                                    record.profit == 0
                                        ? 'text-danger'
                                        : 'text-success'
                                "
                            >
                                {{
                                    record.profit - record.amount > 0 ? "+" : ""
                                }}
                                {{ record.profit - record.amount }}
                            </td>
                            <td class="text-white">
                                <b-icon
                                    icon="chevron-right"
                                    class="text-white"
                                    @click="
                                        modal(
                                            record.colnum,
                                            record.betType,
                                            record.result,
                                            record.rsltClr,
                                            record.amount,
                                            record.profit - record.amount
                                        )
                                    "
                                />
                            </td>
                            <!-- <td class="text-danger">-{{ record.amount }}</td> -->
                        </tr>
                    </table>

                    <Modal v-model="modal1">
                        <p slot="header" style="color:green;text-align:center">
                            <span>More information</span>
                        </p>
                        <div>
                            <table class="table tbleclr">
                                <tr>
                                    <th></th>
                                    <th>Number</th>
                                    <th>Color</th>
                                    <th>Bet Amount</th>
                                    <th>Profit</th>
                                </tr>
                                <tr>
                                    <td>Guess</td>
                                    <td>
                                        <span>
                                            {{
                                                betType == "number"
                                                    ? colnum
                                                    : ""
                                            }}</span
                                        >
                                    </td>
                                    <td>
                                        <span
                                            :class="
                                                betType == 'color' ? colnum : ''
                                            "
                                            class="color"
                                        ></span>
                                    </td>
                                    <td>{{ amount }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Result</td>
                                    <td>
                                        <span>
                                            {{
                                                result != ""
                                                    ? result
                                                    : "Pending"
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            v-for="rslt in rsltClr"
                                            class="d-inline"
                                        >
                                            <span
                                                :class="rslt"
                                                class="color"
                                            ></span>
                                        </span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span
                                            :class="
                                                profit > 0
                                                    ? 'text-success'
                                                    : 'text-danger'
                                            "
                                            >{{ profit }}</span
                                        >
                                    </td>
                                </tr>
                            </table>

                            <!-- <b-row>
                                <b-col cols="6">Guess</b-col>
                                <b-col cols="6" class="text-right">
                                    <span
                                        :class="
                                            betType == 'color' ? colnum : ''
                                        "
                                        class="color"
                                    >
                                        {{ betType == "number" ? colnum : "" }}
                                    </span></b-col
                                >
                                <hr />
                                <b-col cols="6">Result</b-col>
                                <b-col cols="6" class="text-right">
                                    <span>
                                        {{ result != "" ? result : "Pending" }}
                                    </span>
                                    <span
                                        v-for="rslt in rsltClr"
                                        class="d-inline"
                                    >
                                        <span
                                            :class="rslt"
                                            class="color"
                                        ></span> </span
                                ></b-col>
                            </b-row> -->
                        </div>

                        <div slot="footer">
                            <Button class="d-none"></Button>
                        </div>
                    </Modal>
                    <!-- </vk-tabs-item>
                        <vk-tabs-item title="Parity">
                            <table class="table table-responsive bg-dark tble ">
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                                <tr>
                                    <td class="text-yellow">Parity</td>
                                    <td class="text-white">20219483948</td>
                                    <td class="text-success">Finished</td>
                                    <td class="text-danger">-1.00</td>
                                </tr>
                            </table>
                        </vk-tabs-item>
                    </vk-tabs> -->
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
            user_data: [],
            modal1: false,
            colnum: "",
            betType: "",
            result: "",
            rsltClr: "",
            amount: "",
            profit: ""
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
                this.user_data = res.data.game_record;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        back() {
            localStorage.setItem("path", "/play");
        },
        modal(colnum, betType, result, rsltClr, amount, profit) {
            this.colnum = colnum;
            this.betType = betType;
            this.result = result;
            this.rsltClr = rsltClr;
            this.amount = amount;
            this.profit = profit;
            this.modal1 = true;
        }
    }
};
</script>

<style>
.tbleclr > tr > th,
.tbleclr > tr > td {
    color: black;
}
tr > td > span > .result.Red,
.color.Red {
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
tr > td > span > .result.Green,
.color.Green {
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
tr > td > span > .result.Violet,
.color.Violet {
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
.color.Green,
.color.Violet,
.color.Red {
    margin-left: 0% !important;
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
</style>
