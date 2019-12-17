<template>
    <div style="width: 300%;">
          <section class="pricing py-5">
            <div class="container">
              <div class="row">
                <!-- Free Tier -->
                <div class="col-lg-4">
                  <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                      <h5 class="card-title text-body text-uppercase text-center">Kostenfrei</h5>
                      <hr />
                      <ul class="fa-ul">
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>Visitenkarten Online-Editor
                        </li>
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>Download als PDF/X
                        </li>
                        <li>
                          <span class="fa-li">
                            <i class="fas fa-check"></i>
                          </span>
                          <strong></strong>
                        </li>
                        <li>
                          <span class="fa-li">
                            <i class="fas fa-check"></i>
                          </span>
                        </li>
                      </ul>
                      <a v-if="getLoginStatus"
                        href="/#/designcard"
                        class="btn btn-block btn-primary text-uppercase"
                      >Zum Editor</a>
                      <a v-else
                        href="/#/register"
                        class="btn btn-block btn-primary text-uppercase"
                      >Jetzt registrieren</a>
                    </div>
                  </div>
                </div>
                <!-- Plus Tier -->
                <div class="col-lg-4">
                  <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                      <h5 class="card-title text-body text-uppercase text-center">Einsteiger</h5>
                      <hr />
                      <ul class="fa-ul">
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>Visitenkarten Online-Editor
                        </li>
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>Download als PDF/X
                        </li>
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>bestellbar bis 190g/qm
                        </li>
                        <li>
                          <span class="fa-li">
                            <i class="fas fa-check"></i>
                          </span>
                          <strong></strong>
                        </li>
                      </ul>
                      <a
                        href="mailto:visitenkartenonline@dieseemailexistiertnicht.de"
                        class="btn btn-block btn-primary text-uppercase"
                      >Kontaktieren Sie uns hier</a>
                    </div>
                  </div>
                </div>
                <!-- Pro Tier -->
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title text-body text-uppercase text-center">Pro</h5>
                      <hr />
                      <ul class="fa-ul">
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>Visitenkarten Online-Editor
                        </li>
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>Download als PDF/X
                        </li>
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>bestellbar bis 270g/qm
                        </li>
                        <li class="text-body">
                          <span class="fa-li">
                            <i class="fas fa-times"></i>
                          </span>persönliche Beratung
                        </li>
                      </ul>
                      <a
                        href="mailto:visitenkartenonline@dieseemailexistiertnicht.de"
                        class="btn btn-block btn-primary text-uppercase"
                      >Kontaktieren Sie uns hier</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
</template>

<script>
export default {
  computed:{
    getLoginStatus(){
      return this.$store.getters.getLoginStatus
    }
  }
}
</script>

<style scoped>
    .pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}



.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 1;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}

</style>