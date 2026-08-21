@props(['featuredAgenda','upcomingAgendas','pastAgendas'])

<section
    id="kegiatan"
    class="relative scroll-mt-32 pt-[42px] pb-10"
    x-data="{
        selectedDate:new Date().toISOString().slice(0,10),
        viewYear:new Date().getFullYear(),
        viewMonth:new Date().getMonth()+1,
        selectedItems:[],
        agendaDates:[],
        loading:false,
        expandedUpcoming:false,
        expandedPast:false,
        modalOpen:false,
        activeAgenda:null,

        iso(d){
            return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0')
        },

        monthLabel(){
            return new Date(this.viewYear,this.viewMonth-1,1).toLocaleDateString(
                'id-ID',
                {month:'long',year:'numeric'}
            )
        },

        monthGrid(){
            const first=new Date(this.viewYear,this.viewMonth-1,1);
            const start=new Date(first);

            start.setDate(
                start.getDate()-((first.getDay()+6)%7)
            );

            return Array.from({length:42},(_,i)=>{
                const d=new Date(start);
                d.setDate(start.getDate()+i);
                return d;
            });
        },

        isCurrentMonth(d){
            return d.getMonth()+1===this.viewMonth
        },

        hasAgenda(d){
            return this.agendaDates.includes(this.iso(d))
        },

        prevMonth(){
            if(--this.viewMonth<1){
                this.viewMonth=12;
                this.viewYear--;
            }

            this.loadMonthDates();
        },

        nextMonth(){
            if(++this.viewMonth>12){
                this.viewMonth=1;
                this.viewYear++;
            }

            this.loadMonthDates();
        },

        goToday(){
            const d=new Date();

            this.viewYear=d.getFullYear();
            this.viewMonth=d.getMonth()+1;

            this.loadMonthDates();
            this.pick(d);
        },

        loadMonthDates(){
            fetch(
                '{{ route('agenda.dates-in-month') }}?year='+
                this.viewYear+
                '&month='+
                this.viewMonth
            )
            .then(r=>r.json())
            .then(d=>this.agendaDates=d);
        },

        pick(d){
            this.selectedDate=this.iso(d);
            this.loading=true;

            fetch(
                '{{ route('agenda.by-date') }}?date='+
                this.selectedDate
            )
            .then(r=>r.json())
            .then(d=>{
                this.selectedItems=d;
                this.loading=false;
            })
            .catch(()=>{
                this.loading=false;
            });
        },

        openAgenda(item){
            this.activeAgenda=item;
            this.modalOpen=true;
            document.body.style.overflow='hidden';
        },

        closeAgenda(){
            this.modalOpen=false;
            this.activeAgenda=null;
            document.body.style.overflow='';
        },

        formatDate(value){
            if(!value)return '-';

            const d=new Date(value);

            return d.toLocaleDateString(
                'id-ID',
                {
                    day:'2-digit',
                    month:'long',
                    year:'numeric'
                }
            );
        },

        formatTimeRange(start,end){
            if(!start)return '-';

            const s=new Date(start);

            const startTime=s.toLocaleTimeString(
                'id-ID',
                {
                    hour:'2-digit',
                    minute:'2-digit',
                    hour12:false
                }
            ).replace('.',':');

            if(
                s.getHours()===0 &&
                s.getMinutes()===0 &&
                !end
            ){
                return 'Sepanjang Hari';
            }

            if(!end){
                return startTime+' WIB';
            }

            const e=new Date(end);

            const endTime=e.toLocaleTimeString(
                'id-ID',
                {
                    hour:'2-digit',
                    minute:'2-digit',
                    hour12:false
                }
            ).replace('.',':');

            return startTime+'–'+endTime+' WIB';
        },

        statusLabel(item){
            if(item?.status)return item.status;
            if(!item?.starts_at)return 'Agenda';

            const now=new Date();
            const start=new Date(item.starts_at);
            const end=item.ends_at
                ? new Date(item.ends_at)
                : start;

            if(now<start)return 'Akan Dimulai';
            if(now>=start && now<=end)return 'Sedang Berlangsung';

            return 'Selesai';
        }
    }"
    x-init="pick(new Date());loadMonthDates()"
    @keydown.escape.window="closeAgenda()"
>
    <div class="max-w-[1240px] mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="text-center mb-7">
            <div class="flex items-center justify-center gap-2.5 text-primary">
                <span
                    class="material-symbols-outlined text-[20px] opacity-60"
                    aria-hidden="true"
                >
                    eco
                </span>

                <h2 class="font-serif text-[28px] md:text-[34px] font-bold">
                    {{ __('Agenda dan Kegiatan BB Pustaka') }}
                </h2>

                <span
                    class="material-symbols-outlined text-[20px] opacity-60 scale-x-[-1]"
                    aria-hidden="true"
                >
                    eco
                </span>
            </div>

            <p class="mt-2 text-[12px] md:text-[13px] text-on-surface-variant">
                {{ __('Informasi jadwal kegiatan, program literasi, dan dokumentasi agenda BB Pustaka.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_360px] gap-4 lg:items-stretch">
            <div class="min-w-0 space-y-4 lg:space-y-0 lg:flex lg:flex-col lg:gap-4">
                <x-agenda.featured :featured-agenda="$featuredAgenda" />
                <x-agenda.past :past-agendas="$pastAgendas" />
            </div>

            <div class="space-y-4 lg:space-y-0 lg:flex lg:flex-col lg:gap-4">
                <x-agenda.calendar />
                <x-agenda.upcoming :upcoming-agendas="$upcomingAgendas" />
            </div>
        </div>
    </div>

    <x-agenda.modal />
</section>
