<template>
<v-card>    
        
     
    <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Recherche forfait..."
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
  <v-data-table
    :headers="headers"
    :items="desserts"
    :search="search"
    sort-by="nom_forfait"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Forfait</v-toolbar-title>
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
                      v-model="editedItem.nom_forfait"
                      label="Nom "
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                  <v-select
                      :items="listHeures"
                      item-text="item"
                item-value="item"
                v-model="editedItem.nombreHeures_forfait"
                      label="Nombre Heures"
              
            ></v-select>
                   
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                      v-model="editedItem.prixLecon_forfait"
                      label="Prix Leçon Conduite"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                  
                    <v-text-field
                      v-model="editedItem.prix_forfait"
                      label="Prix Forfait"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                   <v-select
                      :items="listPermis"
                      item-text="nom_permis"
                      item-value="permis_id"
                       @change="changePermis"
                v-model="editedItem.permis"
                      label="Permis"
              
            ></v-select>

                  
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
                Sauvgarder
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
              <v-btn color="red" text @click="closeDelete">Annuler</v-btn>
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
      listPermis: ['B', 'BAU', 'AAC', 'A2'],      
      listHeures: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50'],      
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          text: 'Nom Forfait',
          align: 'start',
          
          value: 'nom_forfait',
        },
        { text: 'Nombre Heures', value: 'nombreHeures_forfait' },
        { text: 'Prix Leçon Conduite', value: 'prixLecon_forfait'  },
        { text: 'Prix Forfait', value: 'prix_forfait' },
        { text: 'Permis', value: 'permis.nom_permis'  },
        { text: 'Actions', value: 'actions', sortable: false , filterable: false, },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        	
      

        nom_forfait: '',
        nombreHeures_forfait: '',
        prixLecon_forfait: '',
        prix_forfait: '',
        forfait_id: '',
        permis: 
        {
            permis_id: '',
            nom_permis: '',
            vehicule: 'Auto',
            boite: 'Manuelle',
            desc_permis: '',
            created_at: null,
            updated_at: null,
        },
      },
      defaultItem: {
        nom_forfait: '',
        nombreHeures_forfait: '',
        prixLecon_forfait: '',
        prix_forfait: '',
        forfait_id: '',
        permis: 
        {
            permis_id: '',
            nom_permis: '',
            vehicule: 'Auto',
            boite: 'Manuelle',
            desc_permis: '',
            created_at: null,
            updated_at: null,
        },
        
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nouveau forfait' : 'Modifier forfait'
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
            
            nom_forfait: 'Marouane Ben Moussa',
            nombreHeures_forfait: "20",
            prixLecon_forfait: "22/11/1987",
            prix_forfait: "contact@coach-permis.fr",
             forfait_id: '',
              permis: 
                {
                  permis_id: '',
                  nom_permis: 'B',
                  vehicule: 'Auto',
                  boite: 'Manuelle',
                  desc_permis: '',
                  created_at: null,
                  updated_at: null,
              },
              
           
          },
          {
            nom_forfait: 'Ben Moussa Saocen',
            nombreHeures_forfait: "50",
            prixLecon_forfait: "21/02/1990",
            prix_forfait: "ssaocen@gmail.com",
             forfait_id: '',
        permis: 
        {
            permis_id: '',
            nom_permis: 'AAC',
            vehicule: 'Auto',
            boite: 'Manuelle',
            desc_permis: '',
            created_at: null,
            updated_at: null,
        },
        
           
           
          },
          {
            nom_forfait: 'Hadj Abouda Anisse',
            nombreHeures_forfait: "40", 
            prixLecon_forfait: "03/03/1985",
            prix_forfait: "anisse1985@hotmail.com",
            
                  forfait_id: '',
        permis: 
        {
            permis_id: '',
            nom_permis: 'A2',
            vehicule: 'Auto',
            boite: 'Manuelle',
            desc_permis: '',
            created_at: null,
            updated_at: null,
        },
          
           
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