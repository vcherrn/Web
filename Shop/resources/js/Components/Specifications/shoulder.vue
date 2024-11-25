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
                            <td>{{ specification.product_type }} </td>
                        </tr>

                        <tr>
                            <th class="">Сила захвата</th>
                            <td>{{ specification.gripping_power }} Н</td>
                        </tr>
                        <tr>
                            <th class="">Ширина раскрытия</th>
                            <td>{{ specification.opening_width }} *</td>
                        </tr>
                        <tr>
                            <th class="">Вольтаж</th>
                            <td>{{ specification.voltage }} В</td>
                        </tr>
                        <tr>
                            <th class="">Скорость захвата</th>
                            <td>{{ specification.gripping_speed }} мм/c</td>
                        </tr>
                        <tr>
                            <th class="">Вес</th>
                            <td>{{ specification.weight }} г</td>
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