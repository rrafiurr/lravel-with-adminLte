<template>
  <div class="row">
    <div class="col-12">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaction List</h3>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    <th>Sender</th>    
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in transactions" :key="item.id">
                    <th>{{ item.user.name }} <br> {{ item.user.phone_no }}</th>    
                    <th>{{ item.date }}</th>
                    <th>{{ item.amount }}</th>
                    <th>{{ item.proof }}</th>
                    <th v-if="item.status == 1">Submitted</th>
                    <th v-if="item.status == 2">Approved</th>
                    <th v-if="item.status == 3">Rejected</th>
                    <th>
                        <button v-if="item.status == 1" class="btn btn-primary">Approve</button>
                        <button v-if="item.status == 1" class="btn btn-danger">Reject</button>
                    </th>
                  </tr>
                  </tbody>
                </table>
              </div>
              </div>
  </div>
  </div>
</template>

<script>
export default {
    mounted() {
        this.fetch_transactions()
    },
    data() {
        return {
            transactions: [],
        }
    },
    methods: {
    fetch_transactions() {
      axios.get('/transactions')
      .then(response => {
        this.transactions = response.data
      })
      .catch(error => {
        console.log(error)
      })
    }
    }
}
</script>

<style>

</style>