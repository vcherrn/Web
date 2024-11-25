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
              <th class="">Уровень активности</th>
              <td>{{ specification.activity_level }}</td>
            </tr>
            <tr>
              <th class="">Тип</th>
              <td>{{ specification.product_type }}</td>
            </tr>
            <tr>
              <th class="">Макс. масса тела</th>
              <td><span class="Field_37">{{ specification.max_weight }} кг</span></td>
            </tr>
            <tr>
              <th class="">Вес протеза</th>
              <td><span class="Field_4845">{{ specification.weight }} г</span></td>
            </tr>
            <tr>
              <th class="">Соединение в дистальной части</th>
              <td><span class="Field_4845">{{ specification.distal_part_connection }} </span></td>
            </tr>
            <tr>
              <th class="">Соединение в проксимальной части</th>
              <td><span class="Field_4845">{{ specification.proximal_part_connection }} </span></td>
            </tr>
            <tr>
              <th class="">Угол поворота</th>
              <td><span class="Field_4845">{{ specification.t_angle }} *</span></td>
            </tr>
            <tr>
              <th class="">Системная высота</th>
              <td><span class="Field_4845">{{ specification.system_height }} мм</span></td>
            </tr>
            <tr>
              <th class="">Монтажная высота</th>
              <td><span class="Field_4845">{{ specification.montage_height }} мм</span></td>
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
  // props: ['specification'],
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