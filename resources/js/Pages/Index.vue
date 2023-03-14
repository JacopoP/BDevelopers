<script>
export default {
    name: 'ResultsPage',
    data() {
        return {
            developers: [
                { name: 'John Doe', skills: ['JavaScript', 'Vue.js'], rating: 4, reviews: 25 },
                { name: 'Jane Smith', skills: ['HTML', 'CSS', 'Bootstrap'], rating: 5, reviews: 10 },
                { name: 'Bob Johnson', skills: ['React', 'Node.js'], rating: 3, reviews: 5 },
                { name: 'Alice Lee', skills: ['PHP', 'WordPress'], rating: 4, reviews: 3 },
            ]
        };
    }
}
</script>

<template>
    <div class="results-page">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">BDevelopers</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="filters">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="form-group">
                                <label for="min-rating">Minimum rating:</label>
                                <select class="form-control" id="min-rating" v-model="minRating">
                                    <option value="">Any</option>
                                    <option v-for="n in 5" :value="n" :key="n">{{ n }} star{{ n !== 1 ? 's' : '' }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="min-reviews">Minimum reviews:</label>
                                <select class="form-control" id="min-reviews" v-model="minReviews">
                                    <option value="">Any</option>
                                    <option v-for="n in 10" :value="n" :key="n">{{ n }}+</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="results">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4" v-for="(developer, index) in filteredDevelopers" :key="index">
                            <div class="card mb-4">
                                <div class="card-header">{{ developer.name }}</div>
                                <div class="card-body">
                                    <div class="mb-2"><strong>Skills:</strong> {{ developer.skills.join(', ') }}</div>
                                    <div class="mb-2"><strong>Rating:</strong> {{ developer.rating }} stars</div>
                                    <div class="mb-2"><strong>Reviews:</strong> {{ developer.reviews }} reviews</div>
                                    <button class="btn btn-primary">Hire {{ developer.name }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<style>
main {
    padding-top: 80px;
    /* adjust this value to match the height of your navbar */
}
</style>