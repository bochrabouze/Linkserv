<template>
  
        <v-form>

          
       <v-container>
           <v-row justify="space-around" style="padding-buttom:50px;">
    <v-avatar color="indigo">
      <v-icon dark>
        mdi-account-circle
      </v-icon>
    </v-avatar>

      

    <!--v-avatar>
      <img
        src="https://cdn.vuetifyjs.com/images/john.jpg"
        alt="John"
      >
    </v-avatar-->

    <!--v-avatar color="red">
    
      <span class="white--text text-h5">CJ</span>
    </v-avatar-->
 
        <v-col
          cols="12"
          sm="6"
          md="4"
        >
          <v-text-field
            dense
            label="First name"
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
          md="4"
        >
           <v-text-field
            dense
            label="Last name"
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
          md="4"
        >
          <v-text-field
            label="E-mail"
            placeholder="@"
            filled
            rounded
            dense
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
          md="4"
        >
          <v-text-field
            label="Tel"
            placeholder="+216"
            filled
            rounded
            dense
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
          md="4"
        >
           <v-text-field
            label="Adress"
            placeholder="ville, rue, appartement"
            filled
            rounded
            dense
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
          md="4"
        >
          <v-text-field
            label="Profession"
            outlined
            dense
          ></v-text-field>
        </v-col>

    

        </v-row>

 </v-container>
       
  >

    
     <v-row>    </v-row>
     <v-row>    </v-row>

  <v-row>
    <v-btn depressed>
      switch to servant mode
    </v-btn>

 
 <v-row>    </v-row>
 <v-row>    </v-row>


  
    <v-btn
      depressed
      color="error"
    >
     my applications
    </v-btn>

     <v-row>    </v-row>
     <v-row>    </v-row>

  <v-row>    </v-row>



    <v-btn depressed>
      disconnect
    </v-btn>

    </v-row>   
      

     

     </v-form>


  </template>  



    