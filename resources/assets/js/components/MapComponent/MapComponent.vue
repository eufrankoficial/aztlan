<template>
    <div class="MapComponent">
        <div :id="id" style="height: 428px; width: 100%"></div>
    </div>
</template>

<script>
import { accessToken } from '../../config/app';

export default {
    name: "MapComponent",
    props: ['mapname', 'options'],

    mounted() {
        this.mountMap();
    },

    data() {
        return {
            mapurl: `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${accessToken}`,
            maxzoom: 18,
            titlesize: 512,
            zoomoffset: -1,
            id: this.mapname
        };
    },
    methods: {
        mountMap: function () {
            const mymap = L.map(this.id).setView([this.options.lat, this.options.lon], 13);
            L.tileLayer(this.mapurl, {
                maxZoom: this.maxzoom,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: this.titlesize,
                zoomOffset: this.zoomoffset
            }).addTo(mymap);

            L.circle([this.options.lat, this.options.lon], 500, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5
            }).addTo(mymap);

            L.polygon([
                [this.options.lat, this.options.lon]
            ]).addTo(mymap);
        }
    }
};
</script>


