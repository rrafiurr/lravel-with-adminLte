<template>
  <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Transaction</h3>
              </div>
              <form @submit.prevent="save_data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" v-model="amount" placeholder="Enter amount">
                  </div>
                  <div class="form-group">
                    <label>Select</label>
                        <select class="form-control" v-model="transaction_medias_id">
                          <option v-for="ml in media_list" :key="ml.id" :value="ml.id">
                            {{ ml.name }}
                          </option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Proof Details</label>
                        <textarea class="form-control" rows="3" v-model="proof" placeholder="Enter the details"></textarea>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" @submit.prevent="save_data">Submit</button>
                </div>
              </form>
            </div>
        </div>
<!-- </div>
<div class="row"> -->
  <div class="col-12">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Previos Transactions</h3>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Proof</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in transactions" :key="item.id">
                    <th>{{ item.date }}</th>
                    <th>{{ item.amount }}</th>
                    <th>{{ item.proof }}</th>
                    <th v-if="item.status == 1">Submitted</th>
                    <th v-if="item.status == 2">Approved</th>
                    <th v-if="item.status == 3">Rejected</th>
                  </tr>
                  </tbody>
                </table>
              </div>
              </div>
  </div>
</div>
</div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Transaction-create',
  data() {
    return{
      amount:'',
      media:'',
      media_list: [],
      transaction_medias_id: '',
      proof:'',
      transactions: []
    }
  },
  mounted() {
    this.fetch_media()
    this.fetch_transactions()
  },
  methods: {
    fetch_media() {
      axios.get('/transaction-medias')
      .then(response => {
        this.media_list = response.data
      })
      .catch(error => {
        console.log(error)
      })
    },
    save_data() {
      axios.post('/transactions', {
        amount: this.amount,
        transaction_medias_id : this.transaction_medias_id,
        proof: this.proof
      })
      .then(function (response) {
        // console.log(response);
        // location.reload();
        this.fetch_transactions()
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    fetch_transactions() {
      axios.get('/transactions')
      .then(response => {
        this.transactions = response.data
      })
      .catch(error => {
        console.log(error)
      })
    }

  },


}
</script>

<style>

</style>