<template>
  <v-container>
    <div class="item" v-if="item.done == 1">
      <input class="pa-2" type="checkbox" checked @change="updateCheck()" />
      <span class="done pa-2"> {{ item.name }}</span>
      <v-icon class="pa-2" color="red" @click="deleteItem()">{{
        svgTrash
      }}</v-icon>
    </div>
    <div class="item" v-else>
      <input class="pa-2" type="checkbox" @change="updateCheck()" />
      <span class="pa-2"> {{ item.name }}</span>
      <v-icon class="pa-2" color="red" @click="deleteItem()">{{
        svgTrash
      }}</v-icon>
    </div>
  </v-container>
</template>

<script>
import { mdiTrashCan } from "@mdi/js";
export default {
  props: ["item"],
  methods: {
    updateCheck() {
      if (this.item.done == "0") {
        this.item.done = "1";
      } else {
        this.item.done = "0";
      }
      axios
        .put("api/item/" + this.item.id, {
          item: this.item,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$emit("itemchanged");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteItem() {
      axios
        .delete("api/item/" + this.item.id)
        .then((response) => {
          if (response.status == 200) {
            this.$emit("itemchanged");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  data: () => ({
    svgTrash: mdiTrashCan,
  }),
};
</script>

<style scoped>
.done {
  text-decoration: line-through;
  color: #999999;
}

.itemText {
  width: 100%;
  margin-left: 20px;
}

.item {
  display: flex;
  align-items: center;
  justify-content: space-around;
}
</style>