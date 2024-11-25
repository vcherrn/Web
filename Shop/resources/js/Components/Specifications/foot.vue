<template>
  <div >
    <div class="scrollable-table" >
          <div class="table-spec">
            <table tabindex="0">
              <colgroup>
                <col>
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <th class="">Уровень активности</th>
                  <td >{{specification.activity_level}}</td>
                </tr>
                <tr>
                  <th class="">Уровень ампутации</th>
                  <td >{{specification.amputation_rate}}</td>
                </tr>
                <tr>
                  <th class="">Тип</th>
                  <td >{{specification.product_type}}</td>
                </tr>
                <tr>
                  <th class=""  >Макс. масса тела</th>
                  <td  ><span class="Field_37">{{specification.max_weight}} кг</span></td>
                </tr>
                <tr>
                <th class=""  >Сторона</th>
                <td  >{{specification.type_of_side}}</td>
              </tr>
              <tr>
                <th class=""  >Размеры (габариты)</th>
                <td  ><span class="Field_5163">{{ specification.size_of_prosthes }} см</span></td>
              </tr>
              <tr>
                <th class=""  >Вес (без оболочки стопы)</th>
                <td  ><span class="Field_4845">{{specification.weight}} г</span>*</td>
              </tr>
              <tr>
                <th class=""  >Форма оболочки стопы</th>
                <td  >{{ specification.foot_shape  }}</td>
              </tr>
              <tr>
                <th class=""  >Цвет оболочки стопы</th>
                <td  > {{ specification.color }}</td>
              </tr>
              <tr>
                <th class=""  >Системная высота с нормальной оболочкой стопы</th>
                <td  ><span class="Field_11893">{{specification.height}} мм</span>*</td>
              </tr>
              <tr>
                <th class=""  >Материал</th>
                <td  > {{ specification.material }}</td>
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