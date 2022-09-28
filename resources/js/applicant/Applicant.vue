<template>
 
    <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="red"
              fab
                outlined
              dark
              class="mx-2"
              v-bind="attrs"
              v-on="on"
            >
                <v-icon dark>
                mdi-plus
            </v-icon>
            </v-btn>

         
    <v-container>
      <v-row dense>
 
 <v-col
          v-for="(item, i) in desserts"
          :key="i"
          cols="12"
        >
      
       
      
        
   <v-card  >    
      
    <v-img
      src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      height="200px"
    ></v-img>

     <v-card-title
            
                  v-text="item.Profession"
               ></v-card-title>

    <v-card-subtitle>
   Profession 
    </v-card-subtitle>

    <v-card-actions>
      <v-btn
        color="orange lighten-2"
        text
      >
        Description
      </v-btn>

      <v-spacer></v-spacer>

      <v-btn
        icon
        @click="show = !show"
      >
        <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>

         <v-card-title
            
                  v-text="item.Description"
               ></v-card-title>
      </div>
    </v-expand-transition>
     </v-card>
     </v-col >
      </v-row >
        </v-container>
    
    
          </template>
          
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>

                    
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="12"
                    md="12"
                  >
                    <v-text-field
                      v-model="editedItem.Description"
                      label="Description"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                  <v-select
                      :items="listProfessions"
                      item-text="item"
                item-value="item"
                v-model="editedItem.Profession"
                      label="Profession"
              
            ></v-select>
                   
                  </v-col>
                
                  

          
                
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="red"
                text
                @click="close"
              >
                Annuler
              </v-btn>
              <v-btn
                color="red"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
          
        </v-dialog>
  
  
   
      </template>  

        <script>
     
     
  

  export default {
    data: () => ({
        search: '',    
      listProfessions: ['Plumbing ',' Carpentry ',' Gardening ',' Hotel ',' Catering ',' Secretariat ',' Transport ',' Delivery ',' Engineering ',' Technicians', 'Electricity', 'Mechanics',' Industry ' ,'Others'],      
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          text: 'Description',
          align: 'start',
          
          value: 'Description',
        },
        { text: 'Profession', value: 'Profession' },
        
        { text: 'Actions', value: 'actions', sortable: false , filterable: false, },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        	
      

        Description: '',
        Profession: '',
        
      },
      defaultItem: {
        Description: '',
        Profession: '',
       
       
       
      
      },
      show: false,
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Add applicant' : 'Edit applicant'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
       changePermis(selectObj) {
        console.log("selected Moniteur",selectObj)
        const result = this.listPermis.find( ({ permis_id }) => permis_id === selectObj )
        this.editedItem.permis=result
     },
     getPermis(){
                axios.get('/app/permis')
                .then(response => {
                    // console.log(response.data);

                    this.listPermis = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
     },
      initialize () {

          
          // this.getPermis();
          // axios.get('/app/forfait')
          //       .then(response => {
          //           // console.log(response.data);

          //           this.desserts = response.data;
          //       })
          //       .catch(function (error) {
          //           console.error(error);
          //       });
        
         axios.get('/app/applicant')
                .then(response => {
                   console.log(response.data);

                    this.desserts = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                })
        //this.desserts = [
         // {
            
             // Description: 'i am looking for a job with annual contract',
              //Profession: 'hotel',
              
              
           
         // },
         
       
        //]
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        console.log("save");
        console.log(this.editedItem);


       
         axios.post('/app/applicant',this.editedItem)
                .then(response => {
                   console.log(response.data);

                   // this.listPermis = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        if (this.editedIndex > -1) {
          
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>