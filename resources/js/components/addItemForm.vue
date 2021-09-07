<template>
  <div class="addItem">
    <v-text-field v-model="item.name" label="New Task"></v-text-field>
    <v-btn color="primary" elevation="3" @click="addItem()">Add</v-btn>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      item: {
        name: "",
      },
    };
  },
  methods: {
    addItem() {
      if (this.item.name == "") {
        return;
      }

      axios
        .post("api/item/store", {
          item: this.item,
        })
        .then((response) => {
          if (response.status == 201) {
            this.item.name = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style scoped>
.addItem {
  display: flex;
  justify-content: center;
}
</style>