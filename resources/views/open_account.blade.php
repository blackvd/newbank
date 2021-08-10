@extends('layouts.start')

@section('content')
<div class="row layout-top-spacing">

    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{route('open-account')}}" method="post" id="open-account" class="" enctype="multipart/form-data">
                    @csrf
                    <div id="circle-basic">
                        <h3>Type de compte</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="card component-card_2">
                                        <img src="{{asset('assets/img/current_account.jpg')}}" style="height: 420px;" class="card-img-top" alt="widget-card-2">
                                        <div class="card-body">
                                            <h5 class="card-title">Compte Courant</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="btn btn-primary">Plus d'infos</a>
                                                <div class="n-chk">
                                                    <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                                        <input type="checkbox" class="new-control-input required" id="currentAccount" name="accounts[]" value="1">
                                                        <span class="new-control-indicator" for="currentAccount"></span> Compte courant
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card component-card_2">
                                        <img src="{{asset('assets/img/saving_account.jpg')}}" style="height: 420px;" class="card-img-top" alt="widget-card-2">
                                        <div class="card-body">
                                            <h5 class="card-title">Compte Épargne</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="btn btn-primary">Plus d'infos</a>
                                                <div class="n-chk">
                                                    <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                                        <input type="checkbox" class="new-control-input" id="savingAccount" name="accounts[]" value="2">
                                                        <span class="new-control-indicator" for="savingAccount"></span> Compte épargne
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h3>Informations du client</h3>
                        <section>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-4">
                                    <label for="sexe">Sexe</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-classic-primary">
                                                  <input type="radio" class="new-control-input required" name="sexe" value="femme">
                                                  <span class="new-control-indicator"></span>Femme
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-classic-primary">
                                                  <input type="radio" class="new-control-input" name="sexe" value="homme">
                                                  <span class="new-control-indicator"></span>Homme
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="civilite">Civilité</label>
                                    <select class="selectpicker form-control" name="civilite" id="civilite">
                                        <option value="M">M.</option>
                                        <option value="Mlle">Mlle</option>
                                        <option value="Mme">Mme</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nationalite">Nationalité</label>
                                    <input type="text" name="nationalite" class="form-control required" id="nationalite" placeholder="Côte d'Ivoire">
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control required" id="nom" name="nom" placeholder="Nom">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prenoms">Prénoms</label>
                                    <input type="text" class="form-control required" id="prenoms" name="prenoms" placeholder="Prénoms">
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="dateNaissance">Date de naissance</label>
                                    <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active required" type="text" name="date_naissance" max="2000-01-01" placeholder="Selectionnez une Date..">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lieuNaissance">Lieu de naissance</label>
                                    <input type="text" class="form-control required" id="lieuNaissance" name="lieu_naissance" placeholder="Lieu de naissance">
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-4">
                                    <label for="paysResidence">Pays de Residence</label>
                                    <input type="text" name="pays_residence" class="form-control required" id="paysResidence" placeholder="Côte d'Ivoire">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ville">Ville</label>
                                    <input type="text" name="ville" class="form-control required" id="ville" placeholder="Abidjan">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lieuResidence">Lieu de résidence</label>
                                    <input type="text" id="lieuResidence" name="lieu_residence" class="form-control required" placeholder="Lieu de résidence">
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-3">
                                    <label for="typePiece">Type de pièce</label>
                                    <select class="selectpicker form-control" name="type_piece" id="typePiece">
                                        <option value="Attestation d'identité">Attestation d'identité</option>
                                        <option value="CNI">CNI(e)</option>
                                        <option value="Passeport">Passeport</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="noPiece">N° Pièce</label>
                                    <input type="text" class="form-control required" name="no_piece"  id="noPiece">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dateExp">Date d'expiration</label>
                                    <input id="dateExp" class="form-control flatpickr flatpickr-input active required" type="text" name="date_expiration_piece" placeholder="Selectionnez une Date..">

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="paysEmission">Pays d'émission</label>
                                    <input type="text" name="pays_emission_piece" class="form-control required" id="paysEmission" placeholder="Côte d'Ivoire">
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control required" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="numeroTel1">Numero de téléphone 1</label>
                                    <input type="text" class="form-control required" name="numero_telephone_1"  id="numeroTel1">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="numeroTel2">Numero de téléphone 2</label>
                                    <input type="text" class="form-control" name="numero_telephone_2"  id="numeroTel2">
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="statutMarital">Statut marital</label>
                                    <select class="selectpicker form-control" name="statut_marital" id="statutMarital">
                                        <option value="Célibataire">Célibataire</option>
                                        <option value="Marié(e)">Marié(e)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="profession">Profession</label>
                                    <input type="text" id="profession" name="profession" class="form-control required" placeholder="Profession">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="objetCompte">Objet du compte</label>
                                    <input type="text" id="objetCompte" name="objet_compte" class="form-control required" placeholder="Objet du compte">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="initialAmount">Montant Initial</label>
                                    <input type="number" id="initialAmount" name="initial_amount" class="form-control required" placeholder="100000">
                                </div>
                            </div>
                        </section>
                        <h3>Pièces</h3>
                        <section>
                            <div class="form-row mb-4">
                                <div class="form-group offset-3 col-md-6">
                                    <div class="custom-file-container" data-upload-id="photo">
                                        <div class="custom-file-container__image-preview"></div>
                                        <label>Charger votre photo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input required" id="photo" name="photo" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <div class="custom-file-container" data-upload-id="photoPieceRecto">
                                        <div class="custom-file-container__image-preview"></div>
                                        <label>Charger votre pièce recto <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input required" name="piece_recto" id="photoPieceRecto" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-file-container" data-upload-id="photoPieceVerso">
                                        <div class="custom-file-container__image-preview"></div>
                                        <label>Charger votre pièce verso <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input required" name="piece_verso" id="photoPieceVerso" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <div class="custom-file-container" data-upload-id="factureEau">
                                        <div class="custom-file-container__image-preview"></div>
                                        <label>Charger votre facture d'eau <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="facture_eau" id="factureEau" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-file-container" data-upload-id="factureElectricite">
                                        <div class="custom-file-container__image-preview"></div>
                                        <label>Charger votre facture d'électricité <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="facture_electricite" id="factureElectricite" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <div class="custom-file-container" data-upload-id="certificatResi">
                                        <div class="custom-file-container__image-preview"></div>
                                        <label>Charger votre certificat de résidence <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="certificat_residence" id="certificatResi" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-file-container" data-upload-id="signature">
                                        <div class="custom-file-container__image-preview"></div>
                                        <label>Charger votre signature <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Effacer">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input required" name="signature" id="signature" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h3>Termes & Conditions</h3>
                        <section>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus repudiandae tenetur totam, cupiditate perferendis quas, sit delectus neque vitae dolores sint atque autem aliquam minima id, eaque doloribus quis reiciendis obcaecati commodi iusto! Quis corrupti reprehenderit nostrum nobis officiis laborum quaerat doloribus tempora aspernatur aliquam sint est adipisci beatae quidem atque esse exercitationem consectetur impedit ex, corporis recusandae? Nisi inventore maiores quasi at impedit, libero minima iusto rerum asperiores corporis commodi! Iure animi quam provident iusto omnis repellendus laborum, alias cupiditate eos possimus ipsum amet eius quod quidem eveniet esse. Magnam adipisci sed totam quia nesciunt beatae, accusantium id aut?</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id molestias, exercitationem earum quod neque sunt error nemo enim amet deleniti? Voluptatem quaerat repudiandae doloribus alias odio ut nihil error? Doloribus quam ab expedita vero autem nulla magnam officiis nesciunt assumenda repellendus. Harum ut suscipit incidunt repellendus possimus earum quos dignissimos minima maiores? At libero, illum consequatur architecto officiis totam laboriosam! Consequuntur ipsam vitae quis! Dolore veniam distinctio tenetur molestias et omnis cumque necessitatibus nihil blanditiis ab sit, non ex debitis quas delectus inventore quam quasi neque aliquid perferendis at eos rerum ea sint? Eos architecto non sint possimus doloribus voluptas dolores fugiat ipsam nobis magnam voluptatibus dolorem sunt voluptate molestiae quaerat ut accusamus velit, repellat corporis quidem fuga tempora laborum ex? Nobis ipsum dolores culpa deserunt recusandae at beatae natus sunt voluptatem consequuntur repudiandae, pariatur accusamus adipisci provident odit ad doloremque nesciunt facere aliquid tempore neque nostrum blanditiis quidem! Reiciendis.</p>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis hic ad expedita, sit ex saepe veniam assumenda, amet, voluptatem labore eveniet! Inventore odit et, unde commodi aliquid voluptatem velit pariatur ad magni architecto mollitia quasi culpa asperiores delectus, laudantium aliquam dolorem non dicta neque. Consectetur incidunt eligendi error ad dolore.</p>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequatur ut libero nostrum voluptate dicta neque voluptatibus? Molestiae itaque nam voluptatibus. Pariatur expedita facere ducimus ex ad laborum aperiam et a exercitationem minima vitae temporibus maxime est molestias, rem tempore quas debitis, velit sed impedit ut nobis? Blanditiis totam eum sed saepe at quos ut dolorem nobis deleniti aliquam vel alias dolor aut fugit pariatur optio, dignissimos assumenda necessitatibus. Inventore, tempore. In quidem, vel suscipit asperiores excepturi facilis repellendus, voluptatum voluptate itaque praesentium consequatur quos architecto illum hic non incidunt voluptates aliquid eveniet aspernatur pariatur maxime perspiciatis, earum magnam nulla. Nihil rerum minus corrupti eveniet et quos magni dicta, quis mollitia maxime non! Est omnis obcaecati vero eos exercitationem laboriosam provident.</p>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae, omnis dignissimos culpa perferendis vitae nostrum aut distinctio ex minima beatae itaque id exercitationem cupiditate provident corrupti impedit numquam nihil in, magni iste, quas libero? Animi error rem quasi obcaecati aliquid accusamus suscipit eius magnam inventore molestias, quisquam explicabo in molestiae fuga quidem quis odit nesciunt velit commodi aliquam fugit. Dolor quis consequatur, laborum est, itaque ab assumenda possimus aut hic sit totam laboriosam nisi, atque repellat laudantium reprehenderit. Recusandae, vitae?</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia libero pariatur velit iusto ducimus repellat explicabo assumenda praesentium quia nihil sint eaque a at asperiores atque, veritatis accusantium aliquam reiciendis vero nulla. Ullam ipsum dignissimos, tenetur delectus nesciunt impedit voluptatem nobis et recusandae voluptates nihil, iste sit quas veniam excepturi blanditiis deserunt porro iusto fugit. Ipsa, cum eius? Et, recusandae?</p>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima aliquam, soluta praesentium nesciunt dignissimos quibusdam illum cumque fugit, quos animi atque cum. Nam obcaecati ut enim nobis quia hic vitae quaerat debitis assumenda pariatur consequatur quisquam minus exercitationem iste soluta perspiciatis reiciendis magni vel, expedita voluptas, accusamus beatae est repellendus? Ipsa magnam sit omnis id maxime facere accusantium perspiciatis, provident doloremque, eos laudantium incidunt nulla. A quas nobis dolorem quisquam, nulla fugiat cupiditate praesentium dicta alias iste delectus nesciunt ipsa tempora id esse qui corporis omnis, numquam iure vero quod ad? Commodi, explicabo adipisci, in architecto aspernatur aliquid pariatur voluptates blanditiis natus nobis fugiat fugit provident! Dolores, reprehenderit repellendus nihil odio incidunt atque enim quam quis quod maiores? Repellat quae, perspiciatis eaque numquam, pariatur aut, unde maiores quam atque dolorum ea vitae minima ab dicta?</p>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="n-chk">
                                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                          <input type="checkbox" class="new-control-input required" id="termesConditions" name="accord_termes_conditions">
                                          <span class="new-control-indicator"></span>J'ai lu et j'accepte les termes et conditions
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
