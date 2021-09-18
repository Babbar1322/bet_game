<template>
    <b-container>
        <b-row>
            <b-col md="2"></b-col>
            <b-col md="8" class="pl-0 pr-0">
                <b-card class="bg-royalblue mh">
                    <b-row>
                        <b-col cols="6" class="text-white">
                            
                                <Icon type="ios-arrow-back" @click="back"/>
                               Recharge Record </div>
                        </b-col>
                        <b-col cols="6"></b-col>
                    </b-row>

                    <vk-tabs align="justify" class="mt-5">
                        <vk-tabs-item title="All">
                            <table class="table table-responsive bg-dark tble1 ">
                                <tr v-for="pay in payments">
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>{{pay.upi_id}}</div><div>{{pay.updated_at}}</div></td>
                                    <td class="text-right"><div class="text-success" >{{pay.amount}}</div><div class="text-danger">{{pay.status == 1 ? "Paid" : "unPaid"}}</div></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr> -->
                            </table>
                        </vk-tabs-item>
                        <vk-tabs-item title="Paid">
                            <table class="table table-responsive bg-dark tble1 ">
                                <tr v-for="pay in payments" v-if="pay.status == 1">
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>{{pay.upi_id}}</div><div>{{pay.updated_at}}</div></td>
                                    <td class="text-right"><div class="text-success" >{{pay.amount}}</div><div class="text-danger"> Paid</div></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-white"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-white"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-white"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-white"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-white"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-white"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-white"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">Paid</div></td>
                                </tr> -->
                            </table>
                        </vk-tabs-item>
                        <vk-tabs-item title="UnPaid">
                            <table class="table table-responsive bg-dark tble1 ">
                                <tr v-for="pay in payments" v-if="pay.status == 0">
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>{{pay.upi_id}}</div><div>{{pay.updated_at}}</div></td>
                                    <td class="text-right"><div class="text-success" >{{pay.amount}}</div><div class="text-danger"> unPaid</div></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">300.00</div><div class="text-danger">UnPaid</div></td>
                                </tr> -->
                            </table>
                            </vk-tabs-item>
                    </vk-tabs>
                </b-card>
            </b-col>
            <b-col md="2"></b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    data(){
        return {
            payments:[]
        }
    },
    created(){
         axios
            .get("/api/profile", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                }
            })
            .then(res => {
                this.payments = res.data.payment_history;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods:{
        back(){
            this.$router.push("/wallet");
            localStorage.setItem("path","/wallet");
        }
    }
};
</script>

<style>
.tble1 > tr>td{
width: 20%;
}
.tble1{
    border: none !important;
    height: 60vh;
    overflow: scroll;
}
.tble1::-webkit-scrollbar {
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
