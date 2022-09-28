<template>
  <v-row class="fill-height">
    <v-col>
      <v-sheet height="64">
        <v-toolbar flat color="white">
          <!-- <v-btn class="mx-2" outlined fab color="red" dark @click.stop="dialog = true">
            <v-icon  outlined >
              mdi-plus
            </v-icon>
          </v-btn> -->
          <v-btn class="mx-2" outlined fab color="red"  @click="setToday">
            <v-icon  outlined >
              mdi-calendar-today
            </v-icon>
          </v-btn>

         

          <v-btn fab text small @click="prev">
            <v-icon small>mdi-chevron-left</v-icon>
          </v-btn>
          <v-btn fab text small @click="next">
            <v-icon small>mdi-chevron-right</v-icon>
          </v-btn>
          <v-toolbar-title>{{ title }}</v-toolbar-title>
          <div class="flex-grow-1"></div>
          <v-menu bottom right>
            <template v-slot:activator="{ on }">
              <v-btn outlined  color="red" v-on="on">
                <span>{{ typeToLabel[type] }}</span>
                <v-icon right>mdi-menu-down</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item @click="type = 'category'">
                <v-list-item-title>Jour</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = 'week'">
                <v-list-item-title>Semaine</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = 'month'">
                <v-list-item-title>Mois</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = '4day'">
                <v-list-item-title>4 Jours</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-toolbar>
      </v-sheet>

      <v-dialog v-model="dialog" max-width="500">
        <v-card>
          <v-container>
            <v-form @submit.prevent="addEvent">
              
             
              <!-- datePicker start -->
              <v-menu
          v-model="menu2"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="auto"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="computedDateFormatted"
              label="Date"
              readonly
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker
            v-model="date"
            no-title
            @input="menu2 = false"
          ></v-date-picker>
        </v-menu>
        
              <!-- datepicker end -->
            
              <v-select
              :items="itemsHeures"
              label="Heure Depart"
              item-text="item"
        item-value="item"
        v-model="defaultHeure"
              dense
            ></v-select>
            <v-select
              :items="durees"
              item-text="item"
        item-value="item"
        v-model="defaultDuree"
              label="Duree"
              dense
            ></v-select>

             <v-select
        item-text="name"
        item-value="id"
        v-model="defaultSelectedMoniteur"
        label="Moniteur"
        :items="moniteurs"
        dense
      >
      </v-select>

       
             <v-select
        item-text="name"
        item-value="id"
        v-model="defaultSelectedEleve"
        label="Eleve"
        :items="eleves"
        dense
      >
      </v-select>
              

              <v-btn type="submit" outlined color="red" class="mr-4" @click.stop="dialog = false">
                Créer Leçon
              </v-btn>
            </v-form>
          </v-container>
        </v-card>
      </v-dialog>

      <v-dialog v-model="dialogDate" max-width="500">
        <v-card>
          <v-container>
            <v-form @submit.prevent="addEvent">
                
              <!-- datePicker start -->
              <v-menu
          v-model="menu2"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="auto"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="computedDateFormatted"
              label="Date"
              readonly
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker
            v-model="date"
            no-title
            @input="menu2 = false"
          ></v-date-picker>
        </v-menu>
        
              <!-- datepicker end -->
             
         <v-select
              :items="itemsHeures"
              label="Heure Depart"
              item-text="item"
        item-value="item"
        v-model="defaultHeure"
              dense
            ></v-select>
            <v-select
              :items="durees"
              item-text="item"
        item-value="item"
        v-model="defaultDuree"
              label="Duree"
              dense
            ></v-select>

           
             <v-select
             @change="changeEleve"
        item-text="name"
        item-value="id"
        v-model="defaultSelectedEleve"
        label="Eleve"
        :items="eleves"
        dense
      >
      </v-select>
        <v-select
        item-text="name"
        item-value="id"
        @change="changeMoniteur"
        v-model="defaultSelectedMoniteur"
        label="Moniteur"
        :items="moniteurs"
        dense
      >
      </v-select>

       

              <v-btn type="submit" outlined color="red" class="mr-4" @click.stop="dialogDate = false">
                Créer Leçon
              </v-btn>
            </v-form>
          </v-container>
        </v-card>
      </v-dialog>

<v-sheet height="600">
  <v-calendar
  ref="calendar"
  
  v-model="focus"
  color="primary"
  :events="events"
  :event-color="getEventColor"
  :event-margin-bottom="3"
  :now="today"
  :type="type"
  :first-interval="7"
  :interval-count="15"
  
  :interval-format="intervalFormat"
  category-show-all
  :categories="categories"
  @click:event="showEvent"
  @click:more="viewDay"
  @click:date="viewDay"
  @click:time-category="viewInterval"
  @change="updateRange"
  >
  <template v-slot:event="{ event }">
    <div class="v-event-draggable" >
      <strong>{{ event.name }} | {{ event.details }} </strong><br>
      {{ formatEventTime(event.start) }} - {{ formatEventTime(event.end) }} 
      
    </div>
   
  </template>
  </v-calendar>
  <v-menu
  v-model="selectedOpen"
  :close-on-content-click="false"
  :activator="selectedElement"
  
  offset-x
  >
  <v-card color="grey lighten-4" :width="350" flat>
    <v-toolbar :color="selectedEvent.color" dark>
      <v-btn @click="deleteEvent(selectedEvent.id)" icon>
        <v-icon>mdi-delete</v-icon>
      </v-btn>
      <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
      <div class="flex-grow-1"></div>
    </v-toolbar>

    <v-card-text>
      <form v-if="currentlyEditing !== selectedEvent.id">
        {{ selectedEvent.details }}
      </form>
      <form v-else>
        <v-textarea
        v-model="selectedEvent.details"
        type="text"
        style="width: 100%"
        :min-height="100"
        placeholder="add note">
      </v-textarea>
    </form>
  </v-card-text>

  <v-card-actions>
    <v-btn text color="secondary" @click="selectedOpen = false">
      Fermer
    </v-btn>
    <v-btn v-if="currentlyEditing !== selectedEvent.id" text @click.prevent="editEvent(selectedEvent)">
      Modifier
    </v-btn>
    <v-btn text v-else type="submit" @click.prevent="updateEvent(selectedEvent)">
      Enregistrer
    </v-btn>
  </v-card-actions>
</v-card>
</v-menu>
</v-sheet>
</v-col>
</v-row>
</template>

<script>
// import { db } from '@/main'
export default {
  data: (vm) => ({
    // start datepicker
    date: new Date().toISOString().substr(0, 10),
      dateFormatted: vm.formatDate(new Date().toISOString().substr(0, 10)),
      menu1: false,
      menu2: false,
    // end datepicker
  //  select moniteur
  defaultSelectedMoniteur: {
          name: "Ben Moussa Marouane",
          id: "1",

        },
        moniteurs: [
          {
             name: "Ben Moussa Marouane",
             id: "1"
          }, 
          {
            name: "Ben Moussa Saocen",
            id: "2"
          },
          
        ],
  // end select moniteur

  //  select eleve
  defaultSelectedEleve: {
          name: "Eleve2",
          id: "2",
          color: "blue",
          permis: "B"
        },
        eleves: [
          {
             name: "Eleve1",
             id: "1",
             color: "blue",
             permis: "AAC"
          }, 
          {
            name: "Eleve2",
            id: "2",
            color: "blue",
            permis: "B"
          },
          {
            name: "Eleve3",
            id: "3",
            color: "#c7a500",
            permis: "A2"
          },
           {
            name: "Eleve4",
            id: "4",
            color: "blue",
            permis: "B"
          },
           {
            name: "Eleve5",
            id: "5",
            color: "#c7a500",
            permis: "A2"
          },
          

          
        ],
  // end select eleve 
    durees: ['1', '2', '3', '4'],
    defaultDuree:'1',
    itemsHeures: ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'],
    defaultHeure:'08:00',
    today: new Date().toISOString().substr(0, 10),
    focus: new Date().toISOString().substr(0, 10),
    //  categories: ['John Smith', 'Tori Walker'],
    type: 'category',
    categories: ['Ben Moussa Marouane', 'Ben Moussa Saocen',],
    typeToLabel: {
      month: 'Mois',
      week: 'Semaine',
      day: 'Jour',
      category: 'Jour',
      '4day': '4 Jours',
    },
     timestart: null,
     timeend: null,
    name: null,
    details: null,
    start: null,
    end: null,
    color: '#1976D2', // default event color
    currentlyEditing: null,
    selectedEvent: {},
    selectedElement: null,
    selectedOpen: false,
    events: [],
    dialog: false,
    dialogDate: false
  }),
  mounted () {
    this.getEvents()
  },
   watch: {
     //date picker
      date () {
        this.dateFormatted = this.formatDate(this.date)
      },
      //end date picker
    },
  computed: {
    // date picker
  computedDateFormatted () {
        return this.formatDate(this.date)
      },
      // end date picker

    title () {
      const { start, end } = this
      if (!start || !end) {
        return ''
      }
      const startMonth =this.convertMonth(this.monthFormatter(start))
      const endMonth = this.convertMonth(this.monthFormatter(end))
      const suffixMonth = startMonth === endMonth ? '' : endMonth
      const startYear = start.year
      const endYear = end.year
      const suffixYear = startYear === endYear ? '' : endYear
      const startDay = start.day 
      console.log('monthstart',startMonth)
      console.log('monthend',startMonth)

      // + this.nth(start.day)
      const endDay = end.day 
      // + this.nth(end.day)
      switch (this.type) {
        case 'month':
        return `${startMonth} ${startYear}`
        case 'week':
        case '4day':
        return `${startDay} ${startMonth} ${startYear} - ${endDay} ${suffixMonth}  ${suffixYear}`
        case 'day':
        return `${startDay} ${startMonth} ${startYear}`
        case 'category':
        return `${startDay} ${startMonth} ${startYear}`
        
        
      }
      return ''
    },
    monthFormatter () {
      return this.$refs.calendar.getFormatter({
        timeZone: 'UTC', month: 'long',
      })
    }
  },
  methods: {

 changeEleve(selectObj) {
        console.log("selected Eleve",selectObj)
        const result = this.eleves.find( ({ id }) => id === selectObj )
        this.defaultSelectedEleve=result
     },
     changeMoniteur(selectObj) {
        console.log("selected Moniteur",selectObj)
        const result = this.moniteurs.find( ({ id }) => id === selectObj )
        this.defaultSelectedMoniteur=result
     },
    // start datePicker
    formatDate (date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${day}/${month}/${year}`
      },
      parseDate (date) {
        if (!date) return null

        const [day, month, year] = date.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },
    // end datePicker

     formatEventTime(date) {
    return new Date(date).toLocaleTimeString('en-US', {
      hour: "2-digit", 
      minute: "2-digit", 
      hour12: false
    })
  },
    intervalFormat(interval) {
        return interval.time
    },
    async getEvents () {
    //   let snapshot = await db.collection('calEvent').get()
      const events = [
          { 
              id: "1",
              name: "Repos",
              color: "#999999",
              details:"",
               category: this.categories[0],
               start: this.date+" "+"12:00",
               end: this.date+" "+"14:00",
              
              

          },{ 
              id: "2",
              name: "Repos",
              color: "#999999",
              details:"",
               category: this.categories[1],
               start: this.date+" "+"12:00",
               end: this.date+" "+"14:00",

          },
          { 
              id: "3",
              name: "Examen",
              color: "#f06292",
              details:"",
               category: this.categories[1],
               start: this.date+" "+"14:00",
               end: this.date+" "+"18:00",

          },
         
          { 
              id: "5",
              name: "eleve3",
              color: "deep-purple",
               category: this.categories[0],
              details:" permis AC",
              start: "2021-04-26 14:00",
              end: "2021-04-26 16:00"

          },
          { 
              id: "6",
              name: "eleve4",
              color: "cyan",
              details:" permis B",
               category: this.categories[1],
              start: "2021-04-26 09:00",
              end: "2021-04-26 10:00"

          },
          { 
              id: "7",
              name: "eleve5",
              color: "green",
              details:" permis B",
               category: this.categories[1],
              start: "2021-04-26 11:00",
              end: "2021-04-26 13:00"

          },
          { 
              id: "8",
              name: "eleve6",
              color: "orange",
              details:" permis B",
               category: this.categories[1],
              start: "2021-04-26 15:00",
              end: "2021-04-26 17:00"

          }
      
      ]
    //   snapshot.forEach(doc => {
    //     let appData = doc.data()
    //     appData.id = doc.id
    //     events.push(appData)
    //   })
    if (this.events.length<1) {
      this.events = events
    }
      
    },
    setDialogDate( { date }) {
      this.dialogDate = true
      this.focus = date
    },
     viewInterval ({ date, time, category }) {
      console.log('category',category.categoryName,time,date)

const [hh, mm] = time.split(':')
      this.defaultHeure=hh+':00'
      const result = this.moniteurs.find( ({ name }) => name === category.categoryName )
      
      console.log('result',result)
      this.defaultSelectedMoniteur=result
      console.log('time',time)
      console.log('date',date)
      this.setDialogDate(date)
    },
    viewDay ({ date }) {
      this.focus = date
      this.type = 'category'
    },
    getEventColor (event) {
      return event.color
    },
    setToday () {
      this.focus = this.today
      this.type="category"
    },
    prev () {
      this.$refs.calendar.prev()
    },
    next () {
      this.$refs.calendar.next()
    },
    async addEvent () {
      // if (this.name && this.start && this.end) {
         const [h, m] = this.defaultHeure.split(':')
        var res= Number(h)+Number( this.defaultDuree)+":00"
       
        const ev={
           id: this.events.length+1,
          name: "lecon conduite",
          details: this.defaultSelectedEleve.name+" | "+this.defaultSelectedEleve.permis,
           category: this.defaultSelectedMoniteur.name,
          start: this.date+" "+this.defaultHeure,
          end: this.date+" "+res,
          color: this.defaultSelectedEleve.color
        }
        this.defaultHeure=res
        console.log("newEvent",ev)
        this.events.push(ev)
        //this.getEvents()
        this.name = '',
        this.details = '',
        this.start = '',
        this.timestart='';
        this.timeend='';
        this.end = '',
        this.color = ''
      // } else {
      //   alert('You must enter event name, start, and end time')
      // }
    },
    editEvent (ev) {
      this.currentlyEditing = ev.id,
      console.log('adel', ev)
    },
    async updateEvent (ev) {
    //   await db.collection('calEvent').doc(this.currentlyEditing).update({
        
    //   })
     this.events.push( 
     { 
              id: "7",
              name: "Adel1",
              color: "blue",
              details:" permis Adel",
               category: this.categories[this.rnd(0, this.categories.length - 1)],
              start: "2021-04-26 09:00",
              end: "2021-04-26 10:00"

          }),
          this.events.push( 
     { 
              id: "8",
              name: "Adel2",
              color: "blue",
              details:" permis Adel",
               category: this.categories[this.rnd(0, this.categories.length - 1)],
              start: "2021-04-26 11:00",
              end: "2021-04-26 12:00"

          }
     ),
      this.selectedOpen = false,
      this.currentlyEditing = null
    },
    async deleteEvent (ev) {
        console.log(ev)
    //   await db.collection("calEvent").doc(ev).delete()
   this.events= this.events.filter((e)=>e.id !== ev ),
      this.selectedOpen = false
      //event from DB
      //this.getEvents()
    },
    showEvent ({ nativeEvent, event }) {
      const open = () => {
        this.selectedEvent = event
        this.selectedElement = nativeEvent.target
        setTimeout(() => this.selectedOpen = true, 10)
      }
      if (this.selectedOpen) {
        this.selectedOpen = false
        setTimeout(open, 10)
      } else {
        open()
      }
      nativeEvent.stopPropagation()
    },
    updateRange ({ start, end }) {
      this.start = start
      this.end = end
    },
    rnd (a, b) {
        return Math.floor((b - a + 1) * Math.random()) + a
      },
    convertMonth(mo){
     var res=''
const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
const monthNamesFr = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
  "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
];
for (let index = 0; index < monthNames.length; index++) {
  if (mo===monthNames[index]) {
    res=monthNamesFr[index]
      }  
      
    }
    return res
    },
    nth (d) {
      return d > 3 && d < 21
      ? 'th'
      : ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'][d % 10]
    }
  }
 
}
// export type Category = {
//   date: string,
//   time: string,
//   year: number,
//   month: number,
//   day: number,
//   hour: number,
//   minute: number,
//   weekday: number,
//   hasDay: boolean,
//   hasTime: boolean,
//   past: boolean,
//   present: boolean,
//   future: boolean,
//   timeToY:  number | false,
//   timeDelta: number | false,
//   minutesToPixels:  number,
//   week: [
//     {
//       date: string,
//       time: string,
//       year: number,
//       month: number,
//       day: number,
//       hour: number,
//       minute: number,
//       weekday: number,
//       hasDay: boolean,
//       hasTime: boolean,
//       past: boolean,
//       present: boolean,
//       future: boolean
//     }
//   ],
//   category: string | null

// }
</script>