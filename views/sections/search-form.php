<form id="ec-search-form" action="" method="post">
    <div class="container-fluid has-background-white box p-5 mb-6">
        <div class="columns is-desktop">
            <!-- column -->
            <div class="column is-2">
                <div class="field">
                    <label class="label">Location</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="address">
                                <option value="">Select Location</option>
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
                        <button id="ec-search" class="button has-text-white is-fullwidth" type="submit" style="background: #F44932;border: none;">Search</button>
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
                    <label class="label">Rooms</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="room">
                                <option value="">Select Room</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
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
                                <option value="">Select Type</option>
                                <?php foreach(get_room_types() as $rooms) : ?>
                                    <option value="<?php echo $rooms; ?>"><?php echo $rooms; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="column is-2">
                <div class="field">
                    <label class="label">Baths</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="baths">
                                <option value="">Select Bath</option>
                                <?php foreach(get_rooms() as $room) : ?>
                                    <option value="<?php echo $room; ?>"><?php echo $room; ?></option>
                                <?php endforeach; ?>
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
                        <input 
                            name="price_range" 
                            type="text" 
                            id="amount" 
                            data-max="<?php echo get_max_price(); ?>"
                            readonly 
                            style="border:0;color: #F44932;font-weight:bold;background:none;"
                        >
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