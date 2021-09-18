<template>
  
  <b-container>
        <b-row>
            <b-col cols="2"></b-col>
            <b-col class="col-md-8 col-12 pl-0 pr-0 ">
                <b-card class="bg-royalblue mh">
                    <b-row>
                        <b-col cols="12" class="text-white">
                            
                                <Icon type="ios-arrow-back" @click="back" />
                               Reset Password </div>
                        </b-col>
                        <!-- <b-col cols="6"></b-col> -->
                    </b-row>
                    <div class="mt-3">
                         <!-- <Form  label-position="top" > -->
                        <!-- <FormItem label="Old Password">
                            <Input v-model="data" placeholder="Please Enter"></Input>
                        </FormItem> -->
                        <!-- <FormItem label="New Password">
                            <Input type="password" v-model="pwd" placeholder="Please Enter"></Input>
                        </FormItem>
                        <FormItem label="Confirm Password">
                            <Input type="password" v-model="cpwd" placeholder="Please Enter"></Input>
                        </FormItem> -->
                        <div class="form-group">
                         <label > New Password</label>
                        <input type="text" class="form-control cstminpt" placeholder="Please Enter" v-model="pwd">
                         </div>
                         <div class="form-group">
                         <label > Confirm Password</label>
                        <input type="text" class="form-control cstminpt" v-model="cpwd" placeholder="Please Enter">
                        </div>
                        <div class="text-right">
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
        pwd:"",
        cpwd:""
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
                    this.$router.push("/login");
                        localStorage.removeItem("path");
                    localStorage.setItem("route", "/login");
                }
                // this.balance = res.data.balance;
                this.user_id = res.data.user.id;
            })
            .catch(err => {
                console.log(err);
            });
    },
methods:{
reset(){
    if(this.pwd != this.cpwd){
       return this.i('password not match');
    }
    else{
        axios.post("../../api/resetpwd/"+this.user_id,{
            pwd:this.pwd
        }).then(res=>{console.log(res);
        this.pwd="";
        this.cpwd="";
        this.s("password reset successfully");}).catch(err=>{
            this.i(err.response.data.message);
        })
    }
},
 back(){
            this.$router.push("/mine");
            localStorage.setItem("path","/mine");
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
.ivu-form .ivu-form-item-label , label{
        color: #9e9e9e !important;
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