<template>
  
  <b-container>
        <b-row>
            <b-col cols="2"></b-col>
            <b-col class="col-md-8 col-12 pl-0 pr-0">
                <b-card class="bg-royalblue mh">
                    <b-row>
                        <b-col cols="12" class="text-white">
                                <Icon type="ios-arrow-back" @click="back" />
                               Reset Nickname </div>
                        </b-col>
                    </b-row>
                    <div class="mt-3">
                         <!-- <Form  label-position="top" >
                        <FormItem label="Nickname">
                            <Input v-model="name" placeholder="Please Enter"></Input>
                        </FormItem>
                        -->
                        <label class="text-white"> Name</label>
                        <input type="text" class="form-control cstminpt" v-model="name" placeholder="Enter Name">
                        <div class="text-right mt-2">
                        <Button shape="circle" type="success" size="large" @click="reset"> Save</Button>
                        </div>
                        <!-- </Form> -->
                    </div>
                    </b-card>
                    </b-col></b-row>
                     
                    </b-container>

</template>

<script>
export default {
data(){
    return{
        user_id:"",
        name:"",
    }
},
created() {
        axios
            .get("../../../api/profile", {
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
                // this.balance = res.data.balance;
                this.user_id = res.data.user.id;
                this.name=res.data.user.name;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods:{
        reset(){
            axios.post("../../../api/resetname/"+this.user_id,{
                name:this.name
            }).then(res=>{console.log(res);
            this.s("name reset successfully");}).catch(err=>{
                this.i(err.response.data.message);
            })
        }   ,
        back(){
            this.$router.push("/mine/user");
            localStorage.setItem("path","/mine/user");
        }
    
}
}
</script>

<style>
.ivu-form-label-top >div>div>div> input , .cstminpt{
background-color: black  !important;
color:white !important;
border:1px solid black !important;
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