<template>
    <b-container>
        <b-row>
            <b-col md="2"></b-col>
            <b-col md="8" class="pl-0 pr-0">
                <b-card class="bg-royalblue">
                    <b-row>
                        <b-col cols="6" class="text-white">
                            
                                <Icon type="ios-arrow-back" @click="back" />
                               Withdraw Record </div>
                        </b-col>
                        <!-- <b-col cols="6"></b-col> -->
                    </b-row>

                    <vk-tabs align="justify" class="mt-5">
                        <vk-tabs-item title="All">
                            <table class="table table-responsive bg-dark tble1 ">
                                <tr v-for="withs in withdraws">
                                    <td class="text-primary"><div>{{withs.created_at}}</div></td>
                                    <td class="text-right"><div class="text-success">{{withs.amount}}</div><div class="text-danger">{{withs.status ==1 ? 'Completed' : withs.status ==0 ? "Pending": "Rejected"}}</div></td>
                                </tr>
                                
                                
                            </table>
                        </vk-tabs-item>
                        <vk-tabs-item title="Paid">
                             <table class="table table-responsive bg-dark tble1 ">
                                 <tr v-for="withs in withdraws" v-if="withs.status == 1">
                                    <td class="text-primary"><div>{{withs.created_at}}</div></td>
                                    <td class="text-right"><div class="text-success">{{withs.amount}}</div><div class="text-danger">Completed</div></td>
                                </tr>
                               
                                
                            </table>
                        </vk-tabs-item>
                        <!-- <vk-tabs-item title="Fail">
                            <table class="table table-responsive bg-dark tble1 ">
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                                <tr>
                                    <td class="text-primary"><div>Recharge method: UPI</div><div>2021081614434346814</div><div>2021/08/16 12:13:43</div></td>
                                    <td class="text-right"><div class="text-success">800.00</div><div class="text-danger">Fail</div></td>
                                </tr>
                            </table>
                            </vk-tabs-item> -->
                            <vk-tabs-item title="Reject">
                                <table class="table table-responsive bg-dark tble1 ">
                                 <tr v-for="withs in withdraws" v-if="withs.status == -1">
                                    <td class="text-primary"><div>{{withs.created_at}}</div></td>
                                    <td class="text-right"><div class="text-success">{{withs.amount}}</div><div class="text-danger">Rejected</div></td>
                                </tr>
                                </table>
                            </vk-tabs-item>
                            <vk-tabs-item title="Review">
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
            withdraws:[]
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
                this.withdraws = res.data.withdraw_history;
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
.tble{
    border: none !important;
    height: 400px;
    overflow: scroll;
}
.tble::-webkit-scrollbar {
    display: none;
}
</style>
