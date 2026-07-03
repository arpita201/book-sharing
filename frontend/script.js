// Load all books with search and image
if (document.getElementById("bookList")) {
  fetch("../backend/getBooks.php")
    .then(res => res.json())
    .then(data => {
      function displayBooks(books) {
        let html = "";

        books.forEach(b => {
          html += `
            <div class="book-card">
              <img src="../images/${b.image}" class="book-cover">
              <h3>${b.title}</h3>
              <p>${b.author}</p>
              <a class="btn" href="../backend/borrow.php?id=${b.id}">Borrow</a>
            </div>
          `;
        });

        document.getElementById("bookList").innerHTML = html || "No books found.";
      }

      displayBooks(data);

      const searchBox = document.getElementById("searchBox");
      if (searchBox) {
        searchBox.addEventListener("keyup", function () {
          let keyword = this.value.toLowerCase();

          let filteredBooks = data.filter(b =>
            b.title.toLowerCase().includes(keyword) ||
            b.author.toLowerCase().includes(keyword)
          );

          displayBooks(filteredBooks);
        });
      }
    });
}
// Load My Books
if (document.getElementById("myBooks")) {
  fetch("../backend/getMyBooks.php")
    .then(res => res.json())
    .then(data => {
      let html = "";

      data.forEach(b => {
        html += `
          <div class="book-card">
            <img src="../images/${b.image}" class="book-cover">
            <h3>${b.title}</h3>
            <p>${b.author}</p>
          </div>
        `;
      });

      document.getElementById("myBooks").innerHTML = html || "No books found.";
    });
}

// Load Requests
if (document.getElementById("reqList")) {
  fetch("../backend/getMyRequests.php")
    .then(res => res.json())
    .then(data => {
      let html = "";
      data.forEach(r => {
        html += `<div class="book-item"><b>${r.book}</b> - Status: ${r.status}</div>`;
      });
      document.getElementById("reqList").innerHTML = html || "No requests found.";
    });
}

// Admin Requests
if (document.getElementById("adminRequests")) {
  fetch("../backend/getMyRequests.php")
    .then(res => res.json())
    .then(data => {
      let html = "";
      data.forEach(r => {
        html += `
          <div class="book-item">
            <b>${r.book}</b><br>
            Status: ${r.status}<br><br>
            <a class="btn approve-btn" href="../backend/updateRequest.php?id=${r.id}&status=Approved">Approve</a>
            <a class="btn reject-btn" href="../backend/updateRequest.php?id=${r.id}&status=Rejected">Reject</a>
          </div>
        `;
      });
      document.getElementById("adminRequests").innerHTML = html || "No requests found.";
    });
}

// Load Reviews
function loadReviews() {
  if (!document.getElementById("reviewList")) return;

  fetch("../backend/getReviews.php")
    .then(res => res.json())
    .then(data => {
      let html = "";
      data.forEach(rv => {
        html += `
          <div class="review-item">
            <b>Book:</b> ${rv.book}<br>
            <b>Review:</b> ${rv.review}
          </div>
        `;
      });
      document.getElementById("reviewList").innerHTML = html || "No reviews yet.";
    });
}
loadReviews();

// Submit Review
function submitReview() {
  let book = document.getElementById("bookName").value.trim();
  let review = document.getElementById("reviewText").value.trim();

  if (book === "" || review === "") {
    alert("Please enter book name and review.");
    return;
  }

  fetch("../backend/addReview.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
   body:
  "book_name=" + encodeURIComponent(book) +
  "&review=" + encodeURIComponent(review)
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === "success") {
      alert("Review submitted successfully!");
      document.getElementById("bookName").value = "";
      document.getElementById("reviewText").value = "";
      loadReviews();
    } else {
      alert("Error submitting review.");
    }
  });
}
// Load Profile
if (document.getElementById("profileName")) {
  fetch("../backend/getProfile.php")
    .then(res => res.json())
    .then(data => {
      document.getElementById("profileName").innerText = data.name || "Not found";
      document.getElementById("profileEmail").innerText = data.email || "Not found";
    })
    .catch(() => {
      document.getElementById("profileName").innerText = "Error";
      document.getElementById("profileEmail").innerText = "Error";
    });
}

// Dashboard Statistics
if (document.getElementById("totalBooks")) {
  fetch("../backend/dashboardStats.php")
    .then(res => res.json())
    .then(data => {
      document.getElementById("totalBooks").innerText = data.books;
      document.getElementById("pendingReq").innerText = data.pending;
      document.getElementById("approvedReq").innerText = data.approved;
    });
}