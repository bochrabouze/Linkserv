  <template>

    <v-container>
      <v-row dense>
 
 <v-col
          v-for="(item, i) in desserts"
          :key="i"
          cols="12"
        >
          <v-card
            :color="item.color"
            dark
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title
                  class="text-h5"
                  v-text="item.title"
                ></v-card-title>

                <v-card-subtitle v-text="item.artist"></v-card-subtitle>

                <v-card-actions>
                  <v-btn
                    v-if="item.artist === 'Ellie Goulding'"
                    class="ml-2 mt-3"
                    fab
                    icon
                    height="40px"
                    right
                    width="40px"
                  >
                    <v-icon>mdi-play</v-icon>
                  </v-btn>

                  <v-btn
                    v-else
                    class="ml-2 mt-5"
                    outlined
                    rounded
                    small
                  >
                    START RADIO
                  </v-btn>
                </v-card-actions>
              </div>

              <v-avatar
                class="ma-3"
                size="125"
                tile
              >
                <v-img :src="item.src"></v-img>
              </v-avatar>
            </div>
          </v-card>
        </v-col>
         </v-row >
          </v-container>
     

     
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