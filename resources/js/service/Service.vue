<template>
<v-card>    


  
     
    <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="find service..."
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
  <v-data-table
    :headers="headers"
    :items="desserts"
    :search="search"
    sort-by="Description"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>My services</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
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
                  <!-- <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                  <v-select
                      :items="listCategories"
                      item-text="item"
                item-value="item"
                v-model="editedItem.Categorie"
                      label="Categorie"
              
            ></v-select>
                   
                  </v-col> -->
                    <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                      v-model="editedItem.Date"
                      label="Date"
                    ></v-text-field>
                  </v-col>



                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                      v-model="editedItem.Wage"
                      label="Wage"
                    ></v-text-field>
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

        <!-- dialog delete -->
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Voulez vous supprimer le forfait {{editedItem.nom_forfait}} ?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="red" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>

      </v-toolbar>
  </template>

        
    <!-- actions -->
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
       
        color="red"
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil-outline
      </v-icon>
      <v-icon
        small
        
        outlined
        color="red"
        @click="deleteItem(item)"
      >
        mdi-delete-outline
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        
        outlined
        color="red"
        @click="initialize"
      >
       <v-icon dark>
                        mdi-refresh
                    </v-icon>
      </v-btn>
    </template>
  </v-data-table>
   </v-card>
</template>


<script>
  export default {
    data: () => ({
        search: '',    
      //listCategories: ['Plumbing ',' Carpentry ',' Gardening ',' Hotel ',' Catering ',' Secretariat ',' Transport ',' Delivery ',' Engineering ',' Technicians', 'Electricity', 'Mechanics',' Industry ' ,'Others'],      
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          text: 'Description',
          align: 'start',
          
          value: 'Description',
        },
    
         { text: 'Date', value: 'Date' },
        { text: 'Wage(Dt)', value: 'Wage' },
      
        { text: 'Actions', value: 'actions', sortable: false , filterable: false, },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        	
      

        Description: '',
        Date: '',
        Wage: '',
        Response:0,
      },
      defaultItem: {
        
       Description: '',
        Date: '',
        Wage: '',
        Response:0,
        
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New service' : 'Edit service'
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
        
        this.desserts = [
          {
            
            Description: 'i offer my service to repear the bathroom taps',
           
            Date: '16/07/2021',
            Wage: '40',
            Response:0,
              
           
          },
         
       
        ]
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


        axios.get('/app/service')
                .then(response => {
                   console.log(response.data);

                   // this.listPermis = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
         axios.post('/app/service',this.editedItem)
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