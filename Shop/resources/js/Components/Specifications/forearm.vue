<template>
    <div>
        <div class="scrollable-table">
            <div class="table-spec">
                <table tabindex="0">
                    <colgroup>
                        <col>
                        <col>
                    </colgroup>
                    <tbody>
                       
                        <tr>
                            <th class="">Тип</th>
                            <td>{{ specification.product_type }}</td>
                        </tr>
                        
                        <tr>
                            <th class="">Сторона</th>
                            <td>{{ specification.type_of_side }}</td>
                        </tr>
                        <tr>
                            <th class="">Макс. нагрузка на пальцы</th>
                            <td><span class="Field_37">{{ specification.max_fingers_load }} Н</span></td>
                        </tr>
                        <tr>
                            <th class="">Макс. масса тела</th>
                            <td><span class="Field_37">{{ specification.max_weight }} кг</span></td>
                        </tr>
                        <tr>
                            <th class="">Время работы</th>
                            <td><span class="Field_5163">{{ specification.working_time }} ч</span></td>
                        </tr>
                        <tr>
                            <th class="">Функции</th>
                            <td><span class="Field_4845">{{ specification.functions }} </span></td>
                        </tr>
            
                        <tr>
                            <th class="">Цвет</th>
                            <td> {{ specification.color }}</td>
                        </tr>
                       
                        <tr>
                            <th class="">Материал</th>
                            <td> {{ specification.material }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
    
<script>
export default {
    props: {
        specification: {
            type: Object,
            required: true
        }
    },

};
</script>
  
<style>
@import './specStyle.css';
</style>