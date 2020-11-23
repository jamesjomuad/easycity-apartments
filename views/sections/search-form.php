<form id="ec-search-form" action="" method="post">
    <input type="hidden" name="action" value="search_apartments">
    <div class="container-fluid has-background-white box p-5 mb-6">
        <div class="columns is-desktop">
            <!-- column -->
            <div class="column is-2">
                <div class="field">
                    <label class="label">Location</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="location">
                                <option value="0">Select</option>
                                <?php foreach($locations as $location) : ?>
                                    <option value="<?php echo $location ?>"><?php echo $location ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="column is-3">
                <div class="field">
                    <label class="label">Check In</label>
                    <p class="control has-icons-left">
                        <input id="checkIn" class="input" name="in" type="date" placeholder="Check In">
                        <span class="icon is-small is-left">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </p>
                </div>
            </div>
            <!-- column -->
            <div class="column is-3">
                <div class="field">
                    <label class="label">Check Out</label>
                    <p class="control has-icons-left">
                        <input id="checkOut" class="input" name="out" type="date" placeholder="Check Out">
                        <span class="icon is-small is-left">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </p>
                </div>
            </div>
            <!-- colum -->
            <div class="column">
                <div class="is-grouped mt-5 pt-2">
                    <p class="control">
                        <a id="ec-search" class="button has-text-white is-fullwidth" style="background: #F44932;border: none;">Search</a>
                    </p>
                </div>
            </div>
            <!-- colum -->
            <div class="column is-1">
                <div class="is-grouped mt-5 pt-2">
                    <p class="control">
                        <a id="ec-filter" class="button is-fullwidth is-dark">Filter</a>
                    </p>
                </div>
            </div>
            <!-- colum -->
            <div class="column is-1">
                <div class="is-grouped mt-5 pt-2">
                    <p class="control">
                        <button id="ec-clear" class="button is-fullwidth is-ghost" type="button">Clear</button>
                    </p>
                </div>
            </div>
        </div>

        <!-- More filters -->
        <div id="ec-filter-panel" class="columns is-desktop is-hidden box mt-5 has-background-light">
            <!-- column -->
            <div class="column is-2">
                <div class="field">
                    <label class="label">Room</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="room">
                                <option value="0">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="column is-2">
                <div class="field">
                    <label class="label">Type</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="type">
                                <option value="0">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="column is-2">
                <div class="field">
                    <label class="label">Bath</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="bath">
                                <option value="0">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="column">
                <div class="field">
                    <label class="label">
                        Price: 
                        <input name="price_range" type="text" id="amount" readonly style="border:0;color: #F44932;font-weight:bold;background:none;">
                    </label>
                    <div class="control is-expanded">
                        <div class="is-fullwidth">
                            <div id="slider-range" style="margin-top:20px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>